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
                        <h2 class="fw-bold mb-2">Entrar na sua conta</h2>
                        <p class="text-muted">Acesse sua conta para continuar</p>
                    </div>

                    <!-- Formulário -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <!-- Campo Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">E-mail</label>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   class="form-control form-control-lg"
                                   placeholder="seu@email.com"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Campo Senha -->
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

                        <!-- Lembrar de mim -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label text-muted" for="remember">
                                    Lembrar de mim
                                </label>
                            </div>
                        </div>

                        <!-- Botão Entrar -->
                        <button type="submit" class="btn primary w-100 py-3 fw-semibold mb-4">
                            Entrar na conta
                        </button>

                        <!-- Divisor -->
                        <div class="auth-divider">
                            <span>ou</span>
                        </div>

                        <!-- Botões de Registro -->
                        <div class="d-grid gap-3">
                            <a href="{{ route('register.freelancer') }}" class="btn secondary py-3 fw-semibold">
                                Criar conta como Freelancer
                            </a>
                            <a href="{{ route('register.empresa') }}" class="btn secondary py-3 fw-semibold">
                                Criar conta como Empresa
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection