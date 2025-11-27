@extends('layouts.app')

@section('title', 'Gerenciar Vagas')

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
                                <i class="fas fa-tasks me-2 text-primary"></i>
                                Gerenciar Minhas Vagas
                            </h2>
                            <p class="text-muted mb-0">Acompanhe e gerencie as candidaturas recebidas para suas vagas</p>
                        </div>
                        <a href="{{ route('vagas.create') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-plus me-2"></i>Nova Vaga
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
            
            @if(session('info'))
                <div class="alert alert-info border-0 rounded-3 shadow-sm mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ session('info') }}
                    </div>
                </div>
            @endif

            @if($jobs->count())
                <div class="row">
                    @foreach($jobs as $job)
                        <div class="col-12 mb-4">
                            <div class="card border-0 shadow-sm rounded-3 h-100">
                                <div class="card-header bg-transparent border-0 py-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="fw-bold text-dark mb-1">{{ $job->title }}</h4>
                                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                                <span class="badge bg-{{ $getStatusColor($job->status) }} rounded-pill">
                                                    <i class="{{ $getStatusIcon($job->status) }} me-1 small"></i>
                                                    {{ ucfirst($job->status) }}
                                                </span>
                                                <span class="text-muted">
                                                    <i class="fas fa-users me-1"></i>
                                                    {{ $job->applications_count }} candidatura(s)
                                                </span>
                                                <span class="text-success fw-bold">
                                                    <i class="fas fa-dollar-sign me-1"></i>
                                                    R$ {{ number_format((float)($job->budget ?? 0), 2, ',', '.') }}
                                                </span>
                                                <span class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Prazo: {{ \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') }}
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
                                                    <a class="dropdown-item" href="{{ route('vagas.show', $job->id) }}">
                                                        <i class="fas fa-eye me-2"></i>Ver Vaga
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('vagas.edit', $job->id) }}">
                                                        <i class="fas fa-edit me-2"></i>Editar Vaga
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <p class="text-muted mb-4">{{ Str::limit($job->description, 150) }}</p>

                                    @if($job->applications->count())
                                        <h6 class="fw-bold text-dark mb-3">
                                            <i class="fas fa-users me-2 text-primary"></i>
                                            Candidaturas Recebidas ({{ $job->applications->count() }})
                                        </h6>
                                        <div class="row">
                                            @foreach($job->applications as $application)
                                                <div class="col-md-6 mb-3">
                                                    <div class="card border rounded-3 h-100">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-start mb-3">
                                                                <img src="{{ $application->freelancer->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($application->freelancer->name) . '&color=7F9CF5&background=EBF4FF' }}" 
                                                                     alt="{{ $application->freelancer->name }}"
                                                                     class="rounded-circle me-3"
                                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                                                <div>
                                                                    <h6 class="fw-bold text-dark mb-1">{{ $application->freelancer->name }}</h6>
                                                                    <p class="text-muted small mb-2">
                                                                        <i class="fas fa-envelope me-1"></i>
                                                                        {{ $application->freelancer->email }}
                                                                    </p>
                                                                    @if($application->freelancer->skills)
                                                                        <div class="mb-2">
                                                                            @foreach(explode(',', $application->freelancer->skills) as $skill)
                                                                                @if(trim($skill) && $loop->index < 3)
                                                                                    <span class="badge bg-light text-dark rounded-pill me-1 small">
                                                                                        {{ trim($skill) }}
                                                                                    </span>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="bg-light rounded p-3 mb-3">
                                                                <p class="text-dark small mb-0">
                                                                    <strong>Proposta:</strong> 
                                                                    {{ $application->proposal_text }}
                                                                </p>
                                                            </div>
                                                            
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <span class="badge bg-{{ $getStatusColor($application->status) }} rounded-pill">
                                                                    <i class="{{ $getStatusIcon($application->status) }} me-1"></i>
                                                                    {{ ucfirst($application->status) }}
                                                                </span>

                                                                <div class="d-flex gap-2">
                                                                    @if($application->status == 'pendente')
                                                                        <form method="POST" action="{{ route('vagas.application.update', $application->id) }}" class="d-inline">
                                                                            @csrf 
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="status" value="aceito">
                                                                            <button type="submit" class="btn btn-success btn-sm rounded-pill">
                                                                                <i class="fas fa-check me-1"></i>Aceitar
                                                                            </button>
                                                                        </form>
                                                                        <form method="POST" action="{{ route('vagas.application.update', $application->id) }}" class="d-inline">
                                                                            @csrf 
                                                                            @method('PATCH')
                                                                            <input type="hidden" name="status" value="rejeitado">
                                                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">
                                                                                <i class="fas fa-times me-1"></i>Rejeitar
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                    
                                                                    <a href="mailto:{{ $application->freelancer->email }}" 
                                                                       class="btn btn-outline-primary btn-sm rounded-pill">
                                                                        <i class="fas fa-envelope me-1"></i>Contatar
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-users fa-3x text-muted opacity-50 mb-3"></i>
                                            <h5 class="text-muted">Nenhuma candidatura recebida</h5>
                                            <p class="text-muted">Esta vaga ainda não recebeu candidaturas.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- PAGINAÇÃO --}}
                <div class="d-flex justify-content-center mt-4">
                    {{ $jobs->links() }}
                </div>
            @else
                {{-- NENHUMA VAGA CRIADA --}}
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-briefcase fa-4x text-muted opacity-50 mb-3"></i>
                        <h4 class="text-muted mb-3">Nenhuma vaga publicada</h4>
                        <p class="text-muted mb-4">Comece criando sua primeira vaga para encontrar freelancers qualificados.</p>
                        <a href="{{ route('vagas.create') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                            <i class="fas fa-plus me-2"></i>Criar Primeira Vaga
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

/* Garantir que o dropdown funcione */
.dropdown-menu {
    z-index: 1000;
}

.dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-bottom: 0;
    border-left: 0.3em solid transparent;
}
</style>

{{-- SCRIPT PARA GARANTIR QUE O DROPDOWN FUNCIONE --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Inicializando dropdowns...');
    
    // Verifica se Bootstrap está disponível
    if (typeof bootstrap !== 'undefined') {
        console.log('✅ Bootstrap JS carregado');
        
        // Inicializa todos os dropdowns manualmente
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl);
        });
        
        console.log('✅ Dropdowns inicializados:', dropdownList.length);
        
        // Adiciona evento de clique para debug
        dropdownElementList.forEach(function(dropdown) {
            dropdown.addEventListener('click', function() {
                console.log('Dropdown clicado:', this);
            });
        });
    } else {
        console.log('❌ Bootstrap não encontrado - usando fallback');
        
        // Fallback manual para dropdowns
        var dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var dropdownMenu = this.nextElementSibling;
                dropdownMenu.classList.toggle('show');
                console.log('Dropdown manual ativado');
            });
        });
        
        // Fecha dropdowns ao clicar fora
        document.addEventListener('click', function() {
            var dropdownMenus = document.querySelectorAll('.dropdown-menu');
            dropdownMenus.forEach(function(menu) {
                menu.classList.remove('show');
            });
        });
    }
});

// Prevenir que clicks dentro do dropdown fechem ele
document.addEventListener('click', function(e) {
    if (e.target.closest('.dropdown-menu')) {
        e.stopPropagation();
    }
});
</script>
@endsection