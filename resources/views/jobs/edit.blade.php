@extends('layouts.app')

@section('title', 'Editar Vaga')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold text-dark mb-0">
                            <i class="fas fa-edit me-2 text-primary"></i>
                            Editar Vaga
                        </h2>
                        <a href="{{ route('vagas.manage') }}" class="btn btn-outline-secondary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i>Voltar
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('vagas.update', $job->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="title" class="form-label fw-bold text-dark">Título da Vaga *</label>
                                <input type="text" 
                                       class="form-control rounded-3 @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $job->title) }}"
                                       placeholder="Ex: Desenvolvedor PHP Laravel Senior"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="budget" class="form-label fw-bold text-dark">Orçamento (R$) *</label>
                                <input type="number" 
                                       step="0.01" 
                                       min="1"
                                       class="form-control rounded-3 @error('budget') is-invalid @enderror" 
                                       id="budget" 
                                       name="budget" 
                                       value="{{ old('budget', $job->budget) }}"
                                       placeholder="Ex: 1500.00"
                                       required>
                                @error('budget')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="deadline" class="form-label fw-bold text-dark">Prazo de Entrega *</label>
                                <input type="date" 
                                       class="form-control rounded-3 @error('deadline') is-invalid @enderror" 
                                       id="deadline" 
                                       name="deadline" 
                                       value="{{ old('deadline', $job->deadline->format('Y-m-d')) }}"
                                       required>
                                @error('deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label fw-bold text-dark">Status da Vaga *</label>
                                <select class="form-select rounded-3 @error('status') is-invalid @enderror" 
                                        id="status" 
                                        name="status"
                                        required>
                                    <option value="aberto" {{ old('status', $job->status) == 'aberto' ? 'selected' : '' }}>
                                        🟢 Aberto - Aceitando candidaturas
                                    </option>
                                    <option value="em andamento" {{ old('status', $job->status) == 'em andamento' ? 'selected' : '' }}>
                                        🔵 Em Andamento - Trabalho em progresso
                                    </option>
                                    <option value="fechado" {{ old('status', $job->status) == 'fechado' ? 'selected' : '' }}>
                                        🔒 Fechado - Não aceita mais candidaturas
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label for="description" class="form-label fw-bold text-dark">Descrição da Vaga *</label>
                                <textarea class="form-control rounded-3 @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="8"
                                          placeholder="Descreva detalhadamente o projeto, requisitos, tecnologias necessárias, expectativas..."
                                          required>{{ old('description', $job->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 pt-3 border-top">
                            <a href="{{ route('vagas.manage') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-2"></i>Atualizar Vaga
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- INFORMAÇÕES DA VAGA --}}
            <div class="card border-0 shadow-sm rounded-3 mt-4">
                <div class="card-header bg-light border-0 py-3">
                    <h5 class="fw-bold text-dark mb-0">
                        <i class="fas fa-info-circle me-2 text-info"></i>
                        Informações da Vaga
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Data de Criação:</strong> 
                                {{ $job->created_at->format('d/m/Y \\à\\s H:i') }}
                            </p>
                            <p class="mb-2">
                                <strong>Última Atualização:</strong> 
                                {{ $job->updated_at->format('d/m/Y \\à\\s H:i') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>Candidaturas Recebidas:</strong> 
                                <span class="badge bg-primary">{{ $job->applications_count ?? 0 }}</span>
                            </p>
                            <p class="mb-0">
                                <strong>Status Atual:</strong> 
                                <span class="badge bg-{{ $getStatusColor($job->status) }}">
                                    <i class="{{ $getStatusIcon($job->status) }} me-1"></i>
                                    {{ ucfirst($job->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.rounded-3 {
    border-radius: 1rem !important;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.card {
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}
</style>

<script>
// Validação de data no frontend
document.addEventListener('DOMContentLoaded', function() {
    const deadlineInput = document.getElementById('deadline');
    const today = new Date().toISOString().split('T')[0];
    
    // Define o mínimo como amanhã
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    const minDate = tomorrow.toISOString().split('T')[0];
    
    deadlineInput.min = minDate;
    
    // Validação em tempo real
    deadlineInput.addEventListener('change', function() {
        if (this.value <= today) {
            alert('⚠️ O prazo deve ser a partir de amanhã!');
            this.value = minDate;
        }
    });
});
</script>
@endsection