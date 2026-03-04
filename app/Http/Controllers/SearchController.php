<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    //Pesquisa vagas por termo (titulo, localizacao, empresa e tags) e
    //se houver termo aplica filtro e depois ordena por mais recentes
    public function __invoke(Request $request): View
    {
        $q = trim((string) $request->query('q', ''));

        $wideJobs = Job::query()
            ->with(['employer', 'tags'])
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($innerQuery) use ($q) {
                    $innerQuery->where('title', 'like', "%{$q}%")
                        ->orWhere('location', 'like', "%{$q}%")
                        ->orWhereHas('employer', fn ($employerQuery) => $employerQuery->where('name', 'like', "%{$q}%"))
                        ->orWhereHas('tags', fn ($tagQuery) => $tagQuery->where('name', 'like', "%{$q}%"));
                });
            })
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->simplePaginate(6)
            ->withQueryString();

        return view('jobs.search', [
            'q' => $q,
            'wideJobs' => $wideJobs,
        ]);
    }
}
