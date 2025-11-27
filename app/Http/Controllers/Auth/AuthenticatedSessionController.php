<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Exibe o formulário de login.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Autentica o usuário.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // CORREÇÃO: Redireciona diretamente para a rota 'dashboard'
            // O DashboardController fará a checagem do 'role' (freelancer/empresa)
            // e mostrará o painel correto.
            return redirect()->route('dashboard'); 
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ])->onlyInput('email');
    }

    /**
     * Logout do usuário.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout(); // Garantindo que o guard seja especificado (boa prática)
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redireciona para a página inicial
        return redirect()->route('home');
    }
}