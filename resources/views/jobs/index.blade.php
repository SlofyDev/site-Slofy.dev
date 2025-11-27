@extends('layouts.app')

@section('title', 'Vagas Disponíveis - Slofy.dev')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Coluna Principal -->
        <div class="col-lg-9">
            <!-- Cabeçalho -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-5">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-4 me-4">
                            <i class="fas fa-briefcase text-primary fa-2x"></i>
                        </div>
                        <div>
                            <h1 class="fw-bold text-dark display-6 mb-2">Vagas Disponíveis</h1>
                            <p class="text-muted fs-5 mb-0">Encontre oportunidades incríveis para mostrar seu talento</p>
                        </div>
                    </div>
                    
                    <!-- Estatísticas -->
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="card bg-light border-0 rounded-3 h-100 hover-stat">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-briefcase text-primary fa-2x mb-3"></i>
                                    <h3 class="fw-bold text-dark mb-1">{{ $jobs->total() }}</h3>
                                    <small class="text-muted">Total de Vagas</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light border-0 rounded-3 h-100 hover-stat">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-building text-success fa-2x mb-3"></i>
                                    <h3 class="fw-bold text-dark mb-1">{{ $jobs->unique('company_id')->count() }}</h3>
                                    <small class="text-muted">Empresas</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light border-0 rounded-3 h-100 hover-stat">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-dollar-sign text-warning fa-2x mb-3"></i>
                                    <h3 class="fw-bold text-dark mb-1">R$ {{ number_format($jobs->avg('budget'), 0, ',', '.') }}</h3>
                                    <small class="text-muted">Orçamento Médio</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light border-0 rounded-3 h-100 hover-stat">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-clock text-info fa-2x mb-3"></i>
                                    <h3 class="fw-bold text-dark mb-1">{{ $jobs->where('deadline', '>=', now())->count() }}</h3>
                                    <small class="text-muted">Com Prazo Ativo</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros Rápidos -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Orçamento</label>
                            <select class="form-select rounded-3 border-0 bg-light">
                                <option selected>Todos os valores</option>
                                <option>Até R$ 1.000</option>
                                <option>R$ 1.000 - R$ 5.000</option>
                                <option>Acima de R$ 5.000</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Prazo</label>
                            <select class="form-select rounded-3 border-0 bg-light">
                                <option selected>Qualquer prazo</option>
                                <option>Esta semana</option>
                                <option>Próximas 2 semanas</option>
                                <option>Este mês</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tipo</label>
                            <select class="form-select rounded-3 border-0 bg-light">
                                <option selected>Todas as vagas</option>
                                <option>Front-end</option>
                                <option>Back-end</option>
                                <option>Full-stack</option>
                                <option>Design</option>
                                <option>Marketing</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de Vagas -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="fw-bold text-dark mb-0">
                            <i class="fas fa-list me-2 text-primary"></i>
                            Oportunidades Recentes
                        </h3>
                        <span class="badge bg-primary fs-6 px-3 py-2">
                            {{ $jobs->count() }} vagas nesta página
                        </span>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    @if($jobs->count())
                        <div class="list-group list-group-flush">
                            @foreach($jobs as $job)
                                <div class="list-group-item border-0 p-4 hover-card">
                                    <div class="row align-items-center">
                                        <div class="col-lg-8">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="bg-primary bg-opacity-10 rounded p-3 me-3">
                                                    <i class="fas fa-briefcase text-primary fa-lg"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h4 class="fw-bold text-dark mb-2">{{ $job->title }}</h4>
                                                    
                                                    <!-- Informações da Empresa -->
                                                    <div class="d-flex align-items-center mb-2">
                                                        <img src="{{ $job->company->profile_photo_url }}" 
                                                             alt="{{ $job->company->company_name ?? $job->company->name }}"
                                                             class="rounded-circle me-2"
                                                             style="width: 24px; height: 24px; object-fit: cover;">
                                                        <span class="text-muted fw-semibold">
                                                            {{ $job->company->company_name ?? $job->company->name }}
                                                        </span>
                                                        <span class="badge bg-success bg-opacity-10 text-success ms-2 small">
                                                            <i class="fas fa-check-circle me-1"></i>Verificada
                                                        </span>
                                                    </div>
                                                    
                                                    <!-- Descrição Resumida -->
                                                    <p class="text-muted mb-3">
                                                        {{ Str::limit(strip_tags($job->description), 200) }}
                                                    </p>
                                                    
                                                    <!-- Metadados -->
                                                    <div class="d-flex flex-wrap gap-4">
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2">
                                                                <i class="fas fa-dollar-sign text-success fa-sm"></i>
                                                            </div>
                                                            <div>
                                                                <small class="text-muted d-block">Orçamento</small>
                                                                <strong class="text-success">R$ {{ number_format($job->budget, 2, ',', '.') }}</strong>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                                                <i class="fas fa-calendar text-primary fa-sm"></i>
                                                            </div>
                                                            <div>
                                                                <small class="text-muted d-block">Prazo</small>
                                                                <strong class="text-dark">{{ $job->deadline->format('d/m/Y') }}</strong>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="d-flex align-items-center">
                                                            <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-2">
                                                                <i class="fas fa-clock text-warning fa-sm"></i>
                                                            </div>
                                                            <div>
                                                                <small class="text-muted d-block">Tempo Restante</small>
                                                                <strong class="text-dark">{{ $job->deadline->diffForHumans() }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4">
                                            <div class="d-flex flex-column gap-3">
                                                <!-- Status -->
                                                <div class="text-center">
                                                    <span class="badge bg-success rounded-pill px-3 py-2 fs-6">
                                                        <i class="fas fa-circle me-1 fa-xs"></i>
                                                        {{ ucfirst($job->status) }}
                                                    </span>
                                                </div>

                                                <!-- Botão Ver Vaga -->
                                                <a href="{{ route('vagas.show', $job->id) }}" 
                                                   class="btn btn-outline-primary rounded-3 py-2 fw-semibold">
                                                    <i class="fas fa-eye me-2"></i>Ver Detalhes
                                                </a>
                                                
                                                <!-- Botão Candidatar -->
                                                @if(auth()->check() && auth()->user()->isFreelancer())
                                                    @php
                                                        $hasApplied = $job->applications->where('freelancer_id', auth()->id())->count() > 0;
                                                    @endphp
                                                    
                                                    @if($hasApplied)
                                                        <button class="btn btn-success rounded-3 py-2 fw-semibold" disabled>
                                                            <i class="fas fa-check me-2"></i>Já Candidatado
                                                        </button>
                                                    @else
                                                        <button type="button" 
                                                                class="btn btn-primary rounded-3 py-2 fw-semibold"
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#applyModal{{ $job->id }}">
                                                            <i class="fas fa-paper-plane me-2"></i>Candidatar-se
                                                        </button>
                                                    @endif
                                                @else
                                                    <a href="{{ route('login') }}" 
                                                       class="btn btn-primary rounded-3 py-2 fw-semibold">
                                                        <i class="fas fa-sign-in-alt me-2"></i>Login para Candidatar
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @if(!$loop->last)
                                    <hr class="my-0 opacity-25">
                                @endif

                                <!-- Modal de Candidatura para cada vaga -->
                                @if(auth()->check() && auth()->user()->isFreelancer())
                                <div class="modal fade" id="applyModal{{ $job->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content border-0 rounded-3">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold text-dark">
                                                    <i class="fas fa-paper-plane me-2 text-primary"></i>
                                                    Candidatar-se para: {{ $job->title }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form action="{{ route('vagas.apply', $job->id) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-4">
                                                        <label for="proposal_text_{{ $job->id }}" class="form-label fw-bold text-dark">
                                                            Sua Proposta <span class="text-danger">*</span>
                                                        </label>
                                                        <textarea name="proposal_text" 
                                                                  id="proposal_text_{{ $job->id }}" 
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
                                                                    <span class="text-success">R$ {{ number_format($job->budget, 2, ',', '.') }}</span>
                                                                </p>
                                                                <p class="mb-0">
                                                                    <strong>Prazo:</strong> 
                                                                    {{ $job->deadline->format('d/m/Y') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="mb-2">
                                                                    <strong>Empresa:</strong> 
                                                                    {{ $job->company->company_name ?? $job->company->name }}
                                                                </p>
                                                                <p class="mb-0">
                                                                    <strong>Status:</strong> 
                                                                    <span class="badge bg-success">{{ ucfirst($job->status) }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="d-flex gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-outline-secondary rounded-3 px-4" data-bs-dismiss="modal">
                                                            Cancelar
                                                        </button>
                                                        <button type="submit" class="btn btn-primary rounded-3 px-4">
                                                            <i class="fas fa-paper-plane me-2"></i>Enviar Candidatura
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        
                        <!-- Paginação -->
                        <div class="card-footer bg-transparent border-0 py-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Mostrando {{ $jobs->firstItem() }} - {{ $jobs->lastItem() }} de {{ $jobs->total() }} vagas
                                </div>
                                <div>
                                    {{ $jobs->links() }}
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Estado Vazio -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-search fa-4x text-muted opacity-50"></i>
                            </div>
                            <h4 class="text-muted mb-3">Nenhuma vaga disponível no momento</h4>
                            <p class="text-muted mb-4">Novas oportunidades serão publicadas em breve.</p>
                            <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-3 px-4">
                                <i class="fas fa-home me-2"></i>Voltar ao Dashboard
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-3">
            <!-- Perfil Rápido -->
            @auth
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body text-center">
                    <img src="{{ auth()->user()->profile_photo_url }}" 
                         alt="Foto de perfil" 
                         class="rounded-circle border-3 border-white shadow mb-3"
                         style="width: 80px; height: 80px; object-fit: cover;">
                    <h6 class="fw-bold text-dark mb-1">{{ auth()->user()->name }}</h6>
                    <p class="text-muted small mb-3">{{ auth()->user()->email }}</p>
                    
                    @if(auth()->user()->isFreelancer())
                        <span class="badge bg-primary rounded-pill px-3 py-2">
                            <i class="fas fa-user-tie me-1"></i>Freelancer
                        </span>
                    @else
                        <span class="badge bg-success rounded-pill px-3 py-2">
                            <i class="fas fa-building me-1"></i>Empresa
                        </span>
                    @endif
                </div>
            </div>
            @endauth
            
            <!-- Dicas -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <h6 class="fw-bold text-dark mb-3">
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        Dicas de Sucesso
                    </h6>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-check text-success mt-1 me-2 fa-xs"></i>
                        <small class="text-muted">Candidate-se rapidamente às vagas do seu interesse</small>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-check text-success mt-1 me-2 fa-xs"></i>
                        <small class="text-muted">Personalize sua proposta para cada vaga</small>
                    </div>
                    <div class="d-flex align-items-start mb-3">
                        <i class="fas fa-check text-success mt-1 me-2 fa-xs"></i>
                        <small class="text-muted">Destaque suas habilidades relevantes</small>
                    </div>
                    <div class="d-flex align-items-start">
                        <i class="fas fa-check text-success mt-1 me-2 fa-xs"></i>
                        <small class="text-muted">Mantenha seu portfólio atualizado</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos Personalizados -->
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

.hover-stat {
    transition: all 0.3s ease;
}

.hover-stat:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}

.rounded-4 {
    border-radius: 1rem !important;
}

.list-group-item:first-child {
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}

.list-group-item:last-child {
    border-bottom-left-radius: 1rem !important;
    border-bottom-right-radius: 1rem !important;
}

.btn {
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
}

/* Responsividade */
@media (max-width: 992px) {
    .col-lg-9 {
        margin-bottom: 2rem;
    }
    
    .d-flex.flex-wrap.gap-4 {
        gap: 1rem !important;
    }
    
    .hover-card:hover {
        transform: none;
    }
}

/* Paginação personalizada */
.pagination .page-link {
    border-radius: 0.5rem;
    margin: 0 2px;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    border-color: #0d6efd;
}

/* Modal estilos */
.modal-content {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    border-color: #86b7fe;
}
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Efeitos de hover suaves
document.querySelectorAll('.hover-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transition = 'all 0.3s ease';
    });
});

// Contador de caracteres para modais
document.querySelectorAll('textarea[id^="proposal_text_"]').forEach(textarea => {
    textarea.addEventListener('input', function() {
        const charCount = this.value.length;
        const maxChars = 1000;
        
        if (charCount > maxChars) {
            this.value = this.value.substring(0, maxChars);
        }
    });
});

// Foco automático nos modais
document.addEventListener('DOMContentLoaded', function() {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('shown.bs.modal', function () {
            const textarea = this.querySelector('textarea');
            if (textarea) {
                textarea.focus();
            }
        });
    });
});
</script>

@endsection