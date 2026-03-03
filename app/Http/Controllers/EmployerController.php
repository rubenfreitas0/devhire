<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployerController extends Controller
{
    public function edit(Request $request, Employer $employer): View
    {
        abort_unless($request->user()?->id === $employer->user_id, 403);

        return view('employers.edit', [
            'employer' => $employer,
        ]);
    }

    public function update(Request $request, Employer $employer): RedirectResponse
    {
        abort_unless($request->user()?->id === $employer->user_id, 403);

        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $employer->update([
            'name' => $attributes['name'],
        ]);

        return redirect()->route('home');
    }
}
