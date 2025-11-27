@extends('layouts.app')

@section('title', 'Criar Nova Vaga - Slofy.dev')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Cabeçalho -->
            <div class="text-center mb-5">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                     style="width: 80px; height: 80px;">
                    <i class="fas fa-briefcase fa-2x text-primary"></i>
                </div>
                <h1 class="fw-bold text-dark display-6 mb-2">Criar Nova Vaga</h1>
                <p class="text-muted fs-5">Publique uma nova oportunidade para encontrar talentos</p>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Header do Card -->
                <div class="card-header bg-gradient-primary text-white py-4 border-0">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3">
                            <i class="fas fa-plus fa-lg"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">Detalhes da Vaga</h3>
                            <p class="mb-0 opacity-75" style="color: white;">Preencha as informações da oportunidade</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">
                    @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle me-3 fa-lg"></i>
                                <div>
                                    <h6 class="fw-bold mb-2">Corrija os seguintes erros:</h6>
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success border-0 rounded-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle me-3 fa-lg"></i>
                                <div class="fw-semibold">{{ session('success') }}</div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('vagas.store') }}" class="needs-validation" novalidate>
                        @csrf

                        <!-- Título da Vaga -->
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-heading me-2 text-primary"></i>Título da Vaga *
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="fas fa-heading text-muted"></i>
                                </span>
                                <input type="text" name="title" id="title" 
                                       class="form-control rounded-3 border-0 bg-light py-3 ps-0 @error('title') is-invalid @enderror"
                                       value="{{ old('title') }}"
                                       placeholder="Ex: Desenvolvedor Front-end React Sênior"
                                       required
                                       minlength="5">
                            </div>
                            @error('title')
                                <div class="text-danger small mt-2 d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                            <div class="form-text text-muted mt-2">
                                <i class="fas fa-lightbulb me-1"></i>Seja claro e objetivo no título (mínimo 5 caracteres)
                            </div>
                        </div>

                        <!-- Descrição da Vaga -->
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold text-dark mb-2">
                                <i class="fas fa-align-left me-2 text-primary"></i>Descrição da Vaga *
                            </label>
                            <div class="position-relative">
                                <textarea name="description" id="description" rows="6"
                                          class="form-control rounded-3 border-0 bg-light py-3 @error('description') is-invalid @enderror"
                                          placeholder="Descreva as responsabilidades, requisitos, benefícios e expectativas para esta vaga..."
                                          required
                                          minlength="10">{{ old('description') }}</textarea>
                                <div class="position-absolute top-0 end-0 mt-3 me-3">
                                    <small class="text-muted"><span id="char-count">0</span>/2000</small>
                                </div>
                            </div>
                            @error('description')
                                <div class="text-danger small mt-2 d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                </div>
                            @enderror
                            <div class="form-text text-muted mt-2">
                                <i class="fas fa-info-circle me-1"></i>Inclua requisitos técnicos, responsabilidades e benefícios (mínimo 10 caracteres)
                            </div>
                        </div>

                        <!-- Orçamento e Prazo -->
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="budget" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-dollar-sign me-2 text-success"></i>Orçamento (R$) *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">
                                        R$
                                    </span>
                                    <input type="number" name="budget" id="budget" 
                                           class="form-control rounded-3 border-0 bg-light py-3 ps-0 @error('budget') is-invalid @enderror"
                                           value="{{ old('budget') }}"
                                           placeholder="0.00"
                                           step="0.01"
                                           min="1"
                                           max="9999999"
                                           required>
                                </div>
                                @error('budget')
                                    <div class="text-danger small mt-2 d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text text-muted mt-2">
                                    <i class="fas fa-coins me-1"></i>Valor total do projeto ou valor por hora
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="deadline" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-calendar-alt me-2 text-primary"></i>Prazo de Entrega *
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="fas fa-calendar text-muted"></i>
                                    </span>
                                    <input type="date" name="deadline" id="deadline" 
                                           class="form-control rounded-3 border-0 bg-light py-3 ps-0 @error('deadline') is-invalid @enderror"
                                           value="{{ old('deadline') }}"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           required>
                                </div>
                                @error('deadline')
                                    <div class="text-danger small mt-2 d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text text-muted mt-2">
                                    <i class="fas fa-clock me-1"></i>Data limite para conclusão do projeto
                                </div>
                            </div>
                        </div>

                        <!-- Dicas para uma boa vaga -->
                        <div class="alert alert-info border-0 rounded-3 mb-4">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-lightbulb text-info mt-1 me-3 fa-lg"></i>
                                <div>
                                    <h6 class="fw-bold text-info mb-2">Dicas para uma vaga atrativa:</h6>
                                    <ul class="mb-0 text-dark">
                                        <li>Seja claro sobre os requisitos técnicos</li>
                                        <li>Descreva as responsabilidades específicas</li>
                                        <li>Mencione benefícios e diferenciais</li>
                                        <li>Defina um prazo realista</li>
                                        <li>Ofereça um orçamento competitivo</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação -->
                        <div class="d-flex gap-3 justify-content-end pt-4 border-top">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-3 px-5 py-3 fw-semibold">
                                <i class="fas fa-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary rounded-3 px-5 py-3 fw-semibold">
                                <i class="fas fa-plus me-2"></i>Criar Vaga
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Contador de caracteres em tempo real
document.getElementById('description').addEventListener('input', function() {
    const charCount = this.value.length;
    document.getElementById('char-count').textContent = charCount;
    
    // Validação visual
    if (charCount < 10) {
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
});

// Validação do prazo
document.getElementById('deadline').addEventListener('change', function() {
    const selectedDate = new Date(this.value);
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    
    if (selectedDate < tomorrow) {
        alert('O prazo deve ser a partir de amanhã.');
        this.value = '';
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
});

// Inicializar contador
document.addEventListener('DOMContentLoaded', function() {
    const initialText = document.getElementById('description').value;
    document.getElementById('char-count').textContent = initialText.length;
});
</script>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    border-color: #86b7fe;
}

.btn-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
}

.is-invalid {
    border-color: #dc3545 !important;
}
</style>
@endsection