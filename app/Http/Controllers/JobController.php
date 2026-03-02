<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Vai buscar a query mais recente
        $jobQuery = Job::query()
            ->with(['employer', 'tags'])
            ->orderByDesc('created_at')
            ->orderByDesc('id');

        return view('jobs.index', [
            // 6 vagas/jobs por página
            // wide_page para evitar conflito no url
            'featuredJobs' => Job::query()
                ->with(['employer', 'tags'])
                ->orderBy('id')
                ->limit(6)
                ->get(),
            'wideJobs' => (clone $jobQuery)->simplePaginate(6, ['*'], 'wide_page'),

            // Tags da barra de pesquisa/filtros
            'tags' => Tag::query()
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request): RedirectResponse
    {
        $user = $request->user();
        $employer = $user?->employer;

        abort_if(!$employer, 403, 'Precisas de uma empresa associada para publicar vagas.');

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

        $tagIds = collect(explode(',', (string) ($attributes['tags'] ?? '')))
            ->map(fn (string $tag) => trim($tag))
            ->filter()
            ->unique()
            ->take(5)
            ->map(fn (string $name) => Tag::query()->firstOrCreate(['name' => $name])->id)
            ->values()
            ->all();

        if (count($tagIds) > 0) {
            $job->tags()->syncWithoutDetaching($tagIds);
        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job): RedirectResponse
    {
        abort_unless(auth()->id() === $job->employer?->user_id, 403);

        $job->delete();

        return redirect()->back();
    }
}
