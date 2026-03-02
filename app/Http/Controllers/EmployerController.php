<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EmployerController extends Controller
{
    //Se não existir vaga associada, bloqueia o acesso com erro 403.
    public function edit(Request $request, Employer $employer): View
    {
        abort_unless($request->user()?->id === $employer->user_id, 403);

        return view('employers.edit', [
            'employer' => $employer,
        ]);
    }

    //Atualiza os dados da vaga e caso define um logo irá guardar a imagem
    //em "public/images/employers" senão ira guardar uma foto default
    public function update(Request $request, Employer $employer): RedirectResponse
    {
        abort_unless($request->user()?->id === $employer->user_id, 403);

        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $logo = $employer->logo;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/employers');

            if (!is_dir($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);
            $logo = $filename;
        }

        $employer->update([
            'name' => $attributes['name'],
            'logo' => $logo,
        ]);

        return redirect()->route('home');
    }
}
