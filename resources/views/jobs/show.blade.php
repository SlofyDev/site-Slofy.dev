@extends('layouts.app')

@section('title', $job->title . ' - Detalhes da Vaga')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- CABEÇALHO DA VAGA --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="flex-grow-1">
                            <h1 class="fw-bold text-dark display-6 mb-3">{{ $job->title }}</h1>
                            
                            {{-- EMPRESA --}}
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="fas fa-building text-primary fa-lg"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold text-dark mb-1">
                                        {{ $job->company->company_name ?? $job->company->name }}
                                    </h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        Empresa verificada
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        {{-- STATUS --}}
                        <div class="text-end">
                            <span class="badge bg-{{ $job->status == 'aberto' ? 'success' : ($job->status == 'em andamento' ? 'primary' : 'secondary') }} rounded-pill fs-6 px-3 py-2">
                                <i class="fas fa-circle me-1 small"></i>
                                {{ ucfirst($job->status) }}
                            </span>
                        </div>
                    </div>

                    {{-- INFORMAÇÕES PRINCIPAIS --}}
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-light border-0 rounded-3 h-100">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-dollar-sign text-success fa-2x mb-3"></i>
                                    <h4 class="fw-bold text-success mb-2">
                                        R$ {{ number_format((float)($job->budget ?? 0), 2, ',', '.') }}
                                    </h4>
                                    <p class="text-muted mb-0">Orçamento</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light border-0 rounded-3 h-100">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-clock text-primary fa-2x mb-3"></i>
                                    <h4 class="fw-bold text-primary mb-2">
                                        {{ \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') }}
                                    </h4>
                                    <p class="text-muted mb-0">Prazo de Entrega</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light border-0 rounded-3 h-100">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-users text-info fa-2x mb-3"></i>
                                    <h4 class="fw-bold text-info mb-2">
                                        {{ $job->applications->count() }}
                                    </h4>
                                    <p class="text-muted mb-0">Candidaturas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DESCRIÇÃO DETALHADA --}}
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-transparent border-0 py-4">
                    <h3 class="fw-bold text-dark mb-0">
                        <i class="fas fa-file-alt me-2 text-primary"></i>
                        Descrição da Vaga
                    </h3>
                </div>
                <div class="card-body p-5">
                    <div class="prose max-w-none">
                        <p class="text-dark fs-5 lh-lg">
                            {{ $job->description }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- AÇÕES --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="fw-bold text-dark mb-1">Interessado nesta vaga?</h5>
                            <p class="text-muted small mb-0">
                                Candidate-se agora e mostre suas habilidades para a empresa.
                            </p>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('dashboard') }}" 
                                   class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                                    <i class="fas fa-arrow-left me-1"></i>Voltar
                                </a>
                                
                                @if(auth()->user()->isFreelancer() && $job->status == 'aberto')
                                    @php
                                        $hasApplied = $job->applications->where('freelancer_id', auth()->id())->count() > 0;
                                    @endphp
                                    
                                    @if($hasApplied)
                                        <button class="btn btn-success btn-sm rounded-pill px-3" disabled>
                                            <i class="fas fa-check me-1"></i>Candidatado
                                        </button>
                                    @else
                                        <button type="button" 
                                                class="btn btn-primary btn-sm rounded-pill px-3"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#applyModal">
                                            <i class="fas fa-paper-plane me-1"></i>Candidatar
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL DE CANDIDATURA --}}
@if(auth()->user()->isFreelancer() && $job->status == 'aberto')
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 rounded-3">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="applyModalLabel">
                    <i class="fas fa-paper-plane me-2 text-primary"></i>
                    Candidatar-se para: {{ $job->title }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('vagas.apply', $job->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="proposal_text" class="form-label fw-bold text-dark">
                            Sua Proposta <span class="text-danger">*</span>
                        </label>
                        <textarea name="proposal_text" 
                                  id="proposal_text" 
                                  rows="6"
                                  class="form-control rounded-3 border-0 bg-light"
                                  placeholder="Descreva por que você é a pessoa ideal para este projeto, suas experiências relevantes e como você pode ajudar a empresa..."
                                  required></textarea>
                        <div class="form-text text-muted">
                            Escreva uma proposta convincente para aumentar suas chances de ser selecionado.
                        </div>
                    </div>
                    
                    <div class="bg-light rounded-3 p-4 mb-4">
                        <h6 class="fw-bold text-dark mb-3">
                            <i class="fas fa-info-circle me-2 text-primary"></i>
                            Informações da Vaga
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Orçamento:</strong> 
                                    <span class="text-success">R$ {{ number_format((float)($job->budget ?? 0), 2, ',', '.') }}</span>
                                </p>
                                <p class="mb-0">
                                    <strong>Prazo:</strong> 
                                    {{ \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Empresa:</strong> 
                                    {{ $job->company->company_name ?? $job->company->name }}
                                </p>
                                <p class="mb-0">
                                    <strong>Candidaturas:</strong> 
                                    {{ $job->applications->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="fas fa-paper-plane me-1"></i>Enviar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

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

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}

.prose {
    max-width: none;
    line-height: 1.75;
}

.prose p {
    margin-bottom: 1rem;
}

.display-6 {
    font-size: 2.5rem;
    font-weight: 700;
}

.lh-lg {
    line-height: 1.8 !important;
}

.modal-content {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    border-color: #86b7fe;
}

/* Botões menores */
.btn-sm {
    padding: 0.375rem 0.75rem !important;
    font-size: 0.875rem !important;
    line-height: 1.5 !important;
}
</style>

{{-- ÍCONES FONT AWESOME --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
{{-- BOOTSTRAP JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- SCRIPT PARA O MODAL --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Foco automático no textarea do modal
    const applyModal = document.getElementById('applyModal');
    if (applyModal) {
        applyModal.addEventListener('shown.bs.modal', function () {
            document.getElementById('proposal_text').focus();
        });
    }
    
    // Contador de caracteres para a proposta
    const proposalText = document.getElementById('proposal_text');
    if (proposalText) {
        proposalText.addEventListener('input', function() {
            const charCount = this.value.length;
            const maxChars = 1000;
            
            if (charCount > maxChars) {
                this.value = this.value.substring(0, maxChars);
            }
        });
    }
});
</script>

@endsection