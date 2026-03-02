<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
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
