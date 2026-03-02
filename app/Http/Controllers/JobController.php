<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JobController extends Controller
{

    //Começa a ir buscar a consulta dos jobs mais recentes depois
    //apresenta os 6 jobs de que são os primeiros 6 ids, depois
    //junta o employer+tags para evitar o N+1 e queries duplicadas e
    //no final envia tudo para a view jobs.index
    public function index(): View
    {
        $jobQuery = Job::query()
            ->orderByDesc('created_at')
            ->orderByDesc('id');

        $featuredJobs = Job::query()
            ->orderBy('id')
            ->limit(6)
            ->get();

        $wideJobs = (clone $jobQuery)->simplePaginate(6, ['*'], 'wide_page');

        $jobsForRelations = $featuredJobs
            ->concat($wideJobs->getCollection())
            ->unique('id')
            ->values();

        $jobsForRelations->load(['employer', 'tags']);

        return view('jobs.index', [
            'featuredJobs' => $featuredJobs,
            'wideJobs' => $wideJobs,
            'tags' => Tag::query()
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('jobs.create');
    }

    //Cria uma nova vaga e garante que o utilizador.
    //está autenticado, valida os dadose cria os registos
    public function store(StoreJobRequest $request): RedirectResponse
    {
        $user = $request->user();
        abort_if(!$user, 403);

        $employer = $user->employer ?? $user->employers()->create([
            'name' => $user->name,
            'logo' => Employer::DEFAULT_LOGO,
        ]);

        $attributes = $request->validated();

        $job = Job::query()->create([
            'employer_id' => $employer->id,
            'title' => $attributes['title'],
            'salary' => $attributes['salary'],
            'location' => $attributes['location'],
            'schedule' => $attributes['schedule'],
            'url' => $attributes['url'],
            'feature' => false,
        ]);

        $tagIds = $this->resolveTagIds($attributes['tags'] ?? null);

        if (count($tagIds) > 0) {
            $job->tags()->syncWithoutDetaching($tagIds);
        }

        return redirect()->route('home');
    }

    //Converte a string de tags recebida no formulario em IDs de tags.
    private function resolveTagIds(?string $rawTags): array
    {
        $tagNames = collect(explode(',', (string) $rawTags))
            ->map(fn (string $tag) => trim($tag))
            ->filter()
            ->unique()
            ->take(5)
            ->values();

        return $tagNames
            ->map(fn (string $name) => Tag::query()->firstOrCreate(['name' => $name])->id)
            ->all();
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }


    //Verifica se o utilizador autenticado e o dono da vaga
    //se nao for dono, bloqueia com erro 403 e caso seja dono
    //tem permissão para editar/alerar.
    public function edit(Job $job): View
    {
        abort_unless(Auth::id() === $job->employer?->user_id, 403);

        return view('jobs.edit', [
            'job' => $job->load('tags'),
        ]);
    }

    //
    public function update(UpdateJobRequest $request, Job $job): RedirectResponse
    {
        $attributes = $request->validated();

        $job->update([
            'title' => $attributes['title'],
            'salary' => $attributes['salary'],
            'location' => $attributes['location'],
            'schedule' => $attributes['schedule'],
            'url' => filled($attributes['url'] ?? null) ? $attributes['url'] : $job->url,
        ]);

        $tagIds = $this->resolveTagIds($attributes['tags'] ?? null);

        $job->tags()->sync($tagIds);

        return redirect()->route('home');
    }


    public function destroy(Job $job): RedirectResponse
    {
        abort_unless(Auth::id() === $job->employer?->user_id, 403);

        $job->delete();

        return redirect()->back();
    }
}
