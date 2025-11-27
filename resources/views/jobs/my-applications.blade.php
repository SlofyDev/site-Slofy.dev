@extends('layouts.app')

@section('title', 'Minhas Candidaturas')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            {{-- CABEÇALHO --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="fw-bold text-dark mb-1">
                                <i class="fas fa-file-alt me-2 text-primary"></i>
                                Minhas Candidaturas
                            </h2>
                            <p class="text-muted mb-0">Acompanhe o status das suas candidaturas enviadas</p>
                        </div>
                        <a href="{{ route('vagas.index') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-search me-2"></i>Buscar Vagas
                        </a>
                    </div>
                </div>
            </div>

            {{-- MENSAGENS --}}
            @if(session('success'))
                <div class="alert alert-success border-0 rounded-3 shadow-sm mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if($applications->count())
                <div class="row">
                    @foreach($applications as $application)
                        <div class="col-12 mb-4">
                            <div class="card border-0 shadow-sm rounded-3 h-100">
                                <div class="card-header bg-transparent border-0 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="fw-bold text-dark mb-1">{{ $application->job->title }}</h4>
                                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                                <span class="badge bg-{{ $getStatusColor($application->status) }} rounded-pill">
                                                    <i class="{{ $getStatusIcon($application->status) }} me-1"></i>
                                                    {{ ucfirst($application->status) }}
                                                </span>
                                                <span class="text-muted">
                                                    <i class="fas fa-building me-1"></i>
                                                    {{ $application->job->company->name }}
                                                </span>
                                                <span class="text-success fw-bold">
                                                    <i class="fas fa-dollar-sign me-1"></i>
                                                    R$ {{ number_format((float)($application->job->budget ?? 0), 2, ',', '.') }}
                                                </span>
                                                <span class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Candidatou-se em: {{ $application->created_at->format('d/m/Y \\à\\s H:i') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary rounded-pill dropdown-toggle" 
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-cog me-1"></i>Ações
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('vagas.show', $application->job->id) }}">
                                                        <i class="fas fa-eye me-2"></i>Ver Vaga
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="mailto:{{ $application->job->company->email }}">
                                                        <i class="fas fa-envelope me-2"></i>Contatar Empresa
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    {{-- DESCRIÇÃO DA VAGA --}}
                                    <div class="mb-4">
                                        <h6 class="fw-bold text-dark mb-2">Descrição da Vaga:</h6>
                                        <p class="text-muted">{{ Str::limit($application->job->description, 200) }}</p>
                                    </div>

                                    {{-- SUA PROPOSTA --}}
                                    <div class="bg-light rounded p-4 mb-4">
                                        <h6 class="fw-bold text-dark mb-3">
                                            <i class="fas fa-paper-plane me-2 text-primary"></i>
                                            Sua Proposta
                                        </h6>
                                        <p class="text-dark mb-0">{{ $application->proposal_text }}</p>
                                    </div>

                                    {{-- INFORMAÇÕES DA EMPRESA --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="fw-bold text-dark mb-3">Informações da Empresa</h6>
                                            <div class="d-flex align-items-start">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ $application->job->company->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($application->job->company->name) . '&color=7F9CF5&background=EBF4FF' }}" 
                                                         alt="{{ $application->job->company->name }}"
                                                         class="rounded-circle"
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fw-bold text-dark mb-1">{{ $application->job->company->name }}</h6>
                                                    <p class="text-muted small mb-1">
                                                        <i class="fas fa-envelope me-1"></i>
                                                        {{ $application->job->company->email }}
                                                    </p>
                                                    @if($application->job->company->phone)
                                                        <p class="text-muted small mb-0">
                                                            <i class="fas fa-phone me-1"></i>
                                                            {{ $application->job->company->phone }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <h6 class="fw-bold text-dark mb-3">Detalhes da Vaga</h6>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class="small mb-1">
                                                        <strong>Prazo:</strong><br>
                                                        <span class="text-muted">
                                                            {{ \Carbon\Carbon::parse($application->job->deadline)->format('d/m/Y') }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="small mb-1">
                                                        <strong>Status da Vaga:</strong><br>
                                                        <span class="badge bg-{{ $getStatusColor($application->job->status) }}">
                                                            {{ ucfirst($application->job->status) }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- PAGINAÇÃO --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $applications->links() }}
                </div>
            @else
                {{-- NENHUMA CANDIDATURA --}}
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-file-alt fa-4x text-muted opacity-50 mb-3"></i>
                        <h4 class="text-muted mb-3">Nenhuma candidatura enviada</h4>
                        <p class="text-muted mb-4">Encontre vagas interessantes e candidate-se para começar a trabalhar.</p>
                        <a href="{{ route('vagas.index') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                            <i class="fas fa-search me-2"></i>Buscar Vagas
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ESTILOS PERSONALIZADOS --}}
<style>
.rounded-3 {
    border-radius: 1rem !important;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.card {
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.badge {
    font-size: 0.75em;
}

.btn-sm {
    padding: 0.25rem 0.75rem;
    font-size: 0.875rem;
}
</style>

{{-- SCRIPT PARA DROPDOWNS --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializa dropdowns do Bootstrap
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
    });
});
</script>
@endsection