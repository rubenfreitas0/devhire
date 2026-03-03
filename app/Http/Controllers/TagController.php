<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    //Mostra os resultados de uma tag especifica.
    public function __invoke(Tag $tag)
    {
        $jobs = $tag->jobs()
            ->with(['employer', 'tags'])
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        return view('tags.results', [
            'tag' => $tag,
            'jobs' => $jobs,
        ]);
    }
}
