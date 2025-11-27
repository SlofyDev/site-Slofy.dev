@extends('layouts.app')

@section('title', 'Painel do Freelancer')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        {{-- COLUNA PRINCIPAL --}}
        <div class="col-lg-8">
            {{-- CABEÇALHO DO PAINEL --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary rounded-circle p-3 me-3">
                            <i class="fas fa-rocket text-white fa-lg"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold text-dark mb-1">Meu Painel</h2>
                            <p class="text-muted mb-0">Veja vagas disponíveis e acompanhe suas candidaturas</p>
                        </div>
                    </div>
                    
                    {{-- ESTATÍSTICAS RÁPIDAS --}}
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card bg-light border-0 rounded-3 h-100">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-briefcase text-primary fa-2x mb-2"></i>
                                    <h4 class="fw-bold text-dark mb-1">{{ $vagas->count() }}</h4>
                                    <small class="text-muted">Vagas Disponíveis</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light border-0 rounded-3 h-100">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-paper-plane text-success fa-2x mb-2"></i>
                                    <h4 class="fw-bold text-dark mb-1">{{ $candidaturasAceitas ?? 0 }}</h4>
                                    <small class="text-muted">Candidaturas Aceitas</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light border-0 rounded-3 h-100">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-star text-warning fa-2x mb-2"></i>
                                    <h4 class="fw-bold text-dark mb-1">{{ $trabalhosConcluidos ?? 0 }}</h4>
                                    <small class="text-muted">Trabalhos Concluídos</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- LISTA DE VAGAS --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-transparent border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
                            <i class="fas fa-briefcase me-2 text-primary"></i>
                            Vagas Disponíveis
                        </h4>
                        <span class="badge bg-primary fs-6">
                            {{ $vagas->count() }} vagas
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($vagas->count())
                        <div class="list-group list-group-flush">
                            @foreach($vagas as $vaga)
                                <div class="list-group-item border-0 p-4 hover-card">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-start mb-2">
                                                <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                                    <i class="fas fa-briefcase text-primary"></i>
                                                </div>
                                                <div>
                                                    <h5 class="fw-bold text-dark mb-1">{{ $vaga->title }}</h5>
                                                    <div class="d-flex align-items-center flex-wrap">
                                                        <span class="text-muted me-3">
                                                            <i class="fas fa-building me-1"></i>
                                                            {{ $vaga->company->company_name ?? $vaga->company->name ?? 'Empresa confidencial' }}
                                                        </span>
                                                        <span class="text-success fw-bold">
                                                            <i class="fas fa-dollar-sign me-1"></i>
                                                            {{ $vaga->budget_formatted }}
                                                        </span>
                                                    </div>
                                                    @if($vaga->deadline)
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock me-1"></i>
                                                            Prazo: {{ $vaga->deadline->format('d/m/Y') }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <a href="{{ route('vagas.show', $vaga->id) }}" 
                                                   class="btn btn-outline-primary btn-sm rounded-pill">
                                                    <i class="fas fa-eye me-1"></i>Ver Vaga
                                                </a>
                                                <form action="{{ route('vagas.apply', $vaga->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="btn btn-primary btn-sm rounded-pill">
                                                        <i class="fas fa-paper-plane me-1"></i>Candidatar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <hr class="my-0">
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-search fa-4x text-muted opacity-50"></i>
                            </div>
                            <h4 class="text-muted mb-3">Nenhuma vaga disponível</h4>
                            <p class="text-muted mb-4">Volte mais tarde para conferir novas oportunidades.</p>
                            <button class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-sync me-2"></i>Atualizar
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-4">
            {{-- PERFIL DO USUÁRIO --}}
            <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 20px;">
                <div class="card-body text-center p-4">
                    {{-- AVATAR --}}
                    <div class="position-relative d-inline-block mb-3">
                        <img src="{{ $user->profile_photo_url }}" 
                             alt="Foto de perfil" 
                             class="rounded-circle border-4 border-white shadow"
                             style="width: 120px; height: 120px; object-fit: cover;">
                        <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-1 border-2 border-white">
                            <i class="fas fa-check text-white fa-xs"></i>
                        </span>
                    </div>

                    {{-- INFORMAÇÕES PESSOAIS --}}
                    <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                    <p class="text-muted small mb-3">
                        <i class="fas fa-envelope me-1"></i>{{ $user->email }}
                    </p>

                    {{-- BIO --}}
                    <div class="bg-light rounded-3 p-3 mb-4">
                        <p class="text-dark mb-0 small">
                            <i class="fas fa-quote-left text-primary me-1"></i>
                            {{ $user->bio ?? 'Sem biografia adicionada.' }}
                        </p>
                    </div>

                    {{-- HABILIDADES --}}
                    <div class="mb-4">
                        <h6 class="fw-bold text-dark mb-3">
                            <i class="fas fa-star text-warning me-1"></i>
                            Minhas Habilidades
                        </h6>
                        @if(!empty($user->skills))
                            <div class="d-flex flex-wrap gap-2 justify-content-center">
                                @foreach(explode(',', $user->skills) as $skill)
                                    @if(trim($skill))
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i>{{ trim($skill) }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-plus-circle fa-2x text-muted mb-2"></i>
                                <p class="text-muted small mb-0">Nenhuma habilidade cadastrada</p>
                            </div>
                        @endif
                    </div>

                    {{-- AÇÕES --}}
                    <div class="d-grid gap-2">
                        <a href="{{ route('profile.edit') }}" 
                           class="btn btn-outline-primary rounded-pill py-2">
                            <i class="fas fa-edit me-2"></i>Editar Perfil
                        </a>
                        <a href="{{ route('applications.index') }}" 
                           class="btn btn-primary rounded-pill py-2">
                            <i class="fas fa-list me-2"></i>Minhas Candidaturas
                        </a>
                    </div>
                </div>
            </div>

            {{-- DICAS RÁPIDAS --}}
            <div class="card border-0 shadow-sm rounded-3 mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold text-dark mb-3">
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        Dicas para Sucesso
                    </h6>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-check text-success mt-1 me-2"></i>
                        <small class="text-muted">Complete seu perfil com habilidades relevantes</small>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-check text-success mt-1 me-2"></i>
                        <small class="text-muted">Candidate-se rapidamente às vagas do seu interesse</small>
                    </div>
                    <div class="d-flex align-items-start">
                        <i class="fas fa-check text-success mt-1 me-2"></i>
                        <small class="text-muted">Mantenha seu portfólio atualizado</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ESTILOS PERSONALIZADOS --}}
<style>
.hover-card {
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.hover-card:hover {
    background-color: #f8f9fa;
    border-left-color: #0d6efd;
    transform: translateX(5px);
}

.sticky-top {
    position: -webkit-sticky;
    position: sticky;
    z-index: 1020;
}

.border-4 {
    border-width: 4px !important;
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}

.rounded-3 {
    border-radius: 1rem !important;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.list-group-item:first-child {
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}

.list-group-item:last-child {
    border-bottom-left-radius: 1rem !important;
    border-bottom-right-radius: 1rem !important;
}
</style>

{{-- ÍCONES FONT AWESOME --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection