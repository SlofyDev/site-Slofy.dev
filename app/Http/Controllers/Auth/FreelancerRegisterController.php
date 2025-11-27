<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password; // Adiciona a regra de senha moderna

class FreelancerRegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-freelancer');
    }

    public function store(Request $request)
    {
        // Validação utilizando a sintaxe moderna (User::class) e regra de senha
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // CORREÇÃO: Usando User::class para a regra unique, melhor prática do Laravel
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class], 
            'password' => ['required', 'string', 'confirmed', Password::default()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // CORREÇÃO/AJUSTE: Mantém o campo 'role' conforme o seu código original
            'role' => 'freelancer', 
        ]);

        Auth::login($user);

        // CORREÇÃO: Garante o redirecionamento para o dashboard
        return redirect()->route('dashboard')->with('success', 'Bem-vindo à plataforma, freelancer!');
    }
}