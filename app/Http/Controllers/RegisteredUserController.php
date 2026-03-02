<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos dados.
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'employer' => ['required', 'string', 'max:255'],
            'job_tags' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ], [
            'password.min' => 'A password deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmacao da password nao corresponde.',
        ]);

        $user = DB::transaction(function () use ($request, $attributes) {
            $user = User::create([
                'name' => $attributes['name'],
                'email' => $attributes['email'],
                'password' => $attributes['password'],
            ]);

            // Usa logo default quando o utilizador nao envia ficheiro.
            $logo = Employer::DEFAULT_LOGO;

            // Se houver upload, guarda no disco publico e fica apenas com o nome do ficheiro.
            if ($request->hasFile('logo')) {
                $uploadedPath = $request->file('logo')->store('images/employers', 'public');
                $logo = str_replace('images/employers/', '', $uploadedPath);
            }

            // Cria o perfil da empresa associado ao user acabado de criar.
            $employer = $user->employer()->create([
                'name' => $attributes['employer'],
                'logo' => $logo,
            ]);

            $locations = ['Lisboa', 'Porto', 'Braga', 'Coimbra', 'Faro', 'Remote', 'Hibrido'];
            $annualSalaryUsd = random_int(45, 140) * 1000;

            // Cria uma vaga inicial para aparecer imediatamente nos mais recentes.
            $job = Job::create([
                'employer_id' => $employer->id,
                'title' => $attributes['employer'],
                'salary' => number_format($annualSalaryUsd, 0, ',', ' ') . ' USD/year',
                'location' => $locations[array_rand($locations)],
                'schedule' => 'full-time',
                'url' => '#',
                'feature' => false,
            ]);

            $randomTagCount = random_int(1, 3);
            $customTagIds = collect(explode(',', (string) ($attributes['job_tags'] ?? '')))
                ->map(fn (string $tag) => trim($tag))
                ->filter()
                ->unique()
                ->take(5)
                ->map(fn (string $name) => Tag::query()->firstOrCreate(['name' => $name])->id)
                ->all();

            $tagIds = $customTagIds;

            if (count($tagIds) === 0) {
                $tagIds = Tag::query()
                    ->inRandomOrder()
                    ->limit($randomTagCount)
                    ->pluck('id')
                    ->all();
            }

            if (count($tagIds) === 0) {
                $fallbackTags = ['Laravel', 'PHP', 'Backend', 'Frontend', 'Remote', 'Senior'];

                $tagIds = collect($fallbackTags)
                    ->shuffle()
                    ->take($randomTagCount)
                    ->map(fn (string $name) => Tag::firstOrCreate(['name' => $name])->id)
                    ->all();
            }

            $job->tags()->syncWithoutDetaching($tagIds);

            return $user;
        });

        Auth::login($user);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
