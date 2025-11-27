@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card auth-card shadow-lg border-0">
                <div class="card-body p-5">
                    <!-- Header do Card -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('img/logo.png') }}" alt="Slofy.Dev" height="50" class="mb-3">
                        <h2 class="fw-bold mb-2">Cadastro Freelancer</h2>
                        <p class="text-muted">Crie sua conta como freelancer</p>
                    </div>

                    <!-- Formulário -->
                    <form action="{{ route('register.freelancer.store') }}" method="POST">
                        @csrf

                        <!-- Nome Completo -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Nome completo</label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   class="form-control form-control-lg"
                                   placeholder="Seu nome completo"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- E-mail -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   class="form-control form-control-lg"
                                   placeholder="seu@email.com"
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gênero -->
                        <div class="mb-4">
                            <label for="gender" class="form-label fw-semibold">Gênero</label>
                            <select name="gender" 
                                    id="gender" 
                                    class="form-select form-control-lg"
                                    required>
                                <option value="" selected disabled>Selecione seu gênero</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Masculino</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Feminino</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Outro</option>
                            </select>
                            @error('gender')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Senha -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Senha</label>
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   class="form-control form-control-lg"
                                   placeholder="Sua senha"
                                   required>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirmar Senha -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmar Senha</label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation"
                                   class="form-control form-control-lg"
                                   placeholder="Confirme sua senha"
                                   required>
                        </div>

                        <!-- Botão Cadastrar -->
                        <button type="submit" class="btn primary w-100 py-3 fw-semibold mb-4">
                            Criar Conta Freelancer
                        </button>

                        <!-- Link para Login -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Já tem uma conta? 
                                <a href="{{ route('login') }}" class="auth-link fw-semibold">Entrar</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection