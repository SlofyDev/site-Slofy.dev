<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Exibe o formulário de registro de freelancer.
     */
    public function createFreelancer()
    {
        return view('auth.register-freelancer');
    }

    /**
     * Salva o registro de freelancer.
     */
    public function storeFreelancer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'gender' => 'required|in:male,female,other',
            'cpf' => 'nullable|string|max:20|unique:users,cpf',
            'date_of_birth' => 'nullable|date',
        ]);

        // Define imagem padrão conforme o gênero
        $defaultProfileImages = [
            'male' => 'storage/profiles/male-default.png',
            'female' => 'storage/profiles/female-default.png',
            'other' => 'storage/profiles/neutral-default.png',
        ];

        $profileImage = $defaultProfileImages[$request->gender] ?? 'storage/profiles/neutral-default.png';

        // Criação do usuário
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'freelancer',
            'gender' => $request->gender,
            'profile_image' => $profileImage,
            'cpf' => $request->cpf,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return redirect()->route('login')->with('success', 'Conta de freelancer criada com sucesso!');
    }

    /**
     * Exibe o formulário de registro de empresa.
     */
    public function createEmpresa()
    {
        return view('auth.register-empresa');
    }

    /**
     * Salva o registro de empresa.
     */
    public function storeEmpresa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'company_name' => 'required|string|max:255',
            'cnpj' => 'required|string|max:20|unique:users,cnpj',
        ]);

        // Usa imagem padrão de empresa
        $defaultProfile = 'storage/profiles/default_company.png';

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'empresa',
            'company_name' => $request->company_name,
            'cnpj' => $request->cnpj,
            'profile_image' => $defaultProfile,
        ]);

        return redirect()->route('login')->with('success', 'Conta de empresa criada com sucesso!');
    }
}
