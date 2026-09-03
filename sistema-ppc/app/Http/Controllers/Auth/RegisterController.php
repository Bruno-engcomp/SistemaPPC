<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisterController extends Controller
{
    public function showRegisterForm(): Response
    {
        return Inertia::render('Auth/Register', [
            'unidades' => Unidade::all(),
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'perfil' => 'required|in:UNIDADE,AVALIADOR,CAMARA',
            'unidade_id' => 'nullable|required_if:perfil,UNIDADE|exists:unidades,id',
        ], [
            'email.unique' => 'Este e-mail já está cadastrado no sistema.',
            'password.confirmed' => 'A confirmação de senha não confere.',
            'unidade_id.required_if' => 'Selecione uma unidade acadêmica para o perfil de Unidade.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'perfil' => $request->perfil,
            'unidade_id' => $request->perfil === 'UNIDADE' ? $request->unidade_id : null,
        ]);

        Auth::login($user);

        $redirectUrl = match($user->perfil) {
            'UNIDADE' => route('unidade.propostas.index'),
            'AVALIADOR' => route('avaliador.index'),
            'CAMARA' => route('camara.index'),
            default => route('unidade.propostas.index'),
        };

        return redirect($redirectUrl);
    }
}
