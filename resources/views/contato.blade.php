@extends('layouts.app')

@section('title', 'Contato & Suporte - Slofy.Dev')

@section('content')
<section class="contact-support py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                {{-- CABEÇALHO --}}
                <div class="text-center mb-5">
                    <div class="mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-headset text-primary fa-2x"></i>
                        </div>
                    </div>
                    <h1 class="fw-bold text-primary display-5 mb-3">Contato & Suporte</h1>
                    <p class="text-muted fs-5">
                        Precisa de ajuda? Nossa equipe está aqui para atendê-lo.
                    </p>
                </div>

                <div class="row g-4">
                    {{-- FORMULÁRIO --}}
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="fw-bold text-dark mb-4">
                                    <i class="fas fa-envelope me-2 text-primary"></i>
                                    Envie sua mensagem
                                </h3>

                                {{-- MENSAGENS DE RETORNO --}}
                                @if(session('success'))
                                    <div class="alert alert-success border-0 rounded-3 d-flex align-items-center mb-4">
                                        <i class="fas fa-check-circle fa-lg me-3 text-success"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1">Mensagem enviada com sucesso!</h6>
                                            {{ session('success') }}
                                        </div>
                                    </div>
                                @elseif ($errors->any())
                                    <div class="alert alert-danger border-0 rounded-3 d-flex align-items-center mb-4">
                                        <i class="fas fa-exclamation-triangle fa-lg me-3 text-danger"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1">Erro no envio</h6>
                                            <ul class="mb-0 ps-3">
                                                @foreach ($errors->all() as $erro)
                                                    <li class="small">{{ $erro }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('contato.enviar') }}">
                                    @csrf

                                    {{-- NOME --}}
                                    <div class="mb-4">
                                        <label for="nome" class="form-label fw-semibold text-dark">
                                            <i class="fas fa-user me-1 text-primary"></i>
                                            Nome completo
                                        </label>
                                        <input type="text" 
                                               name="nome" 
                                               id="nome" 
                                               class="form-control rounded-3 border-0 bg-light py-3"
                                               value="{{ old('nome') }}" 
                                               placeholder="Digite seu nome completo"
                                               required>
                                    </div>

                                    {{-- EMAIL --}}
                                    <div class="mb-4">
                                        <label for="email" class="form-label fw-semibold text-dark">
                                            <i class="fas fa-envelope me-1 text-primary"></i>
                                            E-mail
                                        </label>
                                        <input type="email" 
                                               name="email" 
                                               id="email" 
                                               class="form-control rounded-3 border-0 bg-light py-3"
                                               value="{{ old('email') }}" 
                                               placeholder="seu@email.com"
                                               required>
                                    </div>

                                    {{-- ASSUNTO --}}
                                    <div class="mb-4">
                                        <label for="assunto" class="form-label fw-semibold text-dark">
                                            <i class="fas fa-tag me-1 text-primary"></i>
                                            Assunto
                                        </label>
                                        <select name="assunto" 
                                                id="assunto" 
                                                class="form-select rounded-3 border-0 bg-light py-3"
                                                required>
                                            <option value="">Selecione o assunto...</option>
                                            <option value="duvida" {{ old('assunto') == 'duvida' ? 'selected' : '' }}>Dúvida sobre o funcionamento</option>
                                            <option value="problema" {{ old('assunto') == 'problema' ? 'selected' : '' }}>Relatar um problema</option>
                                            <option value="sugestao" {{ old('assunto') == 'sugestao' ? 'selected' : '' }}>Sugestão de melhoria</option>
                                            <option value="outro" {{ old('assunto') == 'outro' ? 'selected' : '' }}>Outro</option>
                                        </select>
                                    </div>

                                    {{-- MENSAGEM --}}
                                    <div class="mb-4">
                                        <label for="mensagem" class="form-label fw-semibold text-dark">
                                            <i class="fas fa-comment me-1 text-primary"></i>
                                            Mensagem
                                        </label>
                                        <textarea name="mensagem" 
                                                  id="mensagem" 
                                                  class="form-control rounded-3 border-0 bg-light"
                                                  rows="5" 
                                                  placeholder="Descreva sua dúvida, problema ou sugestão..."
                                                  required>{{ old('mensagem') }}</textarea>
                                        <div class="form-text text-muted">
                                            Descreva com detalhes para que possamos ajudá-lo melhor.
                                        </div>
                                    </div>

                                    {{-- BOTÃO --}}
                                    <button type="submit" class="btn btn-primary btn-lg rounded-3 w-100 py-3 fw-semibold">
                                        <i class="fas fa-paper-plane me-2"></i>
                                        Enviar Mensagem
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- INFORMAÇÕES DE CONTATO - COLUNA MAIOR --}}
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm rounded-4 h-100">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="fw-bold text-dark mb-4">
                                    <i class="fas fa-info-circle me-2 text-primary"></i>
                                    Outros canais
                                </h3>

                                {{-- EMAIL --}}
                                <div class="d-flex align-items-start mb-4 p-3 bg-light rounded-3">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                                        <i class="fas fa-envelope text-primary fa-lg"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-1">E-mail</h5>
                                        <a href="mailto:suporte@slofy.dev" class="text-muted text-decoration-none fs-6">
                                            slofy.dev@gmail.com
                                        </a>
                                        <p class="text-muted small mb-0 mt-1">
                                            Para questões gerais e suporte técnico
                                        </p>
                                    </div>
                                </div>

                                {{-- WHATSAPP --}}
                                <div class="d-flex align-items-start mb-4 p-3 bg-light rounded-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                                        <i class="fab fa-whatsapp text-success fa-lg"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-1">WhatsApp</h5>
                                        <a href="https://wa.me/5511999999999" 
                                           target="_blank" 
                                           class="text-muted text-decoration-none fs-6">
                                            (11) 4002-8922
                                        </a>
                                        <p class="text-muted small mb-0 mt-1">
                                            Atendimento rápido e direto
                                        </p>
                                    </div>
                                </div>

                                {{-- HORÁRIO --}}
                                <div class="d-flex align-items-start mb-4 p-3 bg-light rounded-3">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                                        <i class="fas fa-clock text-warning fa-lg"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-1">Horário de atendimento</h5>
                                        <p class="text-muted mb-0 fs-6">
                                            Segunda a Sexta<br>
                                            <strong>das 9h às 18h</strong>
                                        </p>
                                    </div>
                                </div>

                                {{-- TEMPO DE RESPOSTA --}}
                                <div class="d-flex align-items-start mb-4 p-3 bg-light rounded-3">
                                    <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3 flex-shrink-0">
                                        <i class="fas fa-bolt text-info fa-lg"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fw-bold text-dark mb-1">Tempo de resposta</h5>
                                        <p class="text-muted mb-0 fs-6">
                                            Respondemos em até<br>
                                            <strong class="text-success">24 horas úteis</strong>
                                        </p>
                                    </div>
                                </div>

                                {{-- DIVISOR --}}
                                <hr class="my-4">

                                {{-- DICA --}}
                                <div class="bg-primary bg-opacity-5 rounded-3 p-4 border border-primary border-opacity-10">
                                    <h6 class="fw-bold text-dark mb-2">
                                        <i class="fas fa-lightbulb me-1 text-warning"></i>
                                        Dica rápida
                                    </h6>
                                    <p class="text-muted mb-0 small">
                                        Para dúvidas técnicas, inclua prints ou detalhes específicos para agilizarmos sua solução.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FAQ RÁPIDO --}}
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="fw-bold text-dark mb-4 text-center">
                                    <i class="fas fa-question-circle me-2 text-primary"></i>
                                    Perguntas Frequentes
                                </h3>
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start p-3 bg-light rounded-3 h-100">
                                            <i class="fas fa-check text-success mt-1 me-3 fa-lg"></i>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-2">Como me cadastro?</h6>
                                                <p class="text-muted small mb-0">
                                                    Clique em "Cadastrar" e escolha entre perfil de Empresa ou Freelancer.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start p-3 bg-light rounded-3 h-100">
                                            <i class="fas fa-check text-success mt-1 me-3 fa-lg"></i>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-2">É gratuito?</h6>
                                                <p class="text-muted small mb-0">
                                                    Sim, o cadastro e uso básico da plataforma são totalmente gratuitos.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start p-3 bg-light rounded-3 h-100">
                                            <i class="fas fa-check text-success mt-1 me-3 fa-lg"></i>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-2">Como recebo pagamentos?</h6>
                                                <p class="text-muted small mb-0">
                                                    O pagamento é combinado diretamente entre freelancer e empresa.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start p-3 bg-light rounded-3 h-100">
                                            <i class="fas fa-check text-success mt-1 me-3 fa-lg"></i>
                                            <div>
                                                <h6 class="fw-bold text-dark mb-2">Posso editar minha vaga?</h6>
                                                <p class="text-muted small mb-0">
                                                    Sim, empresas podem editar vagas a qualquer momento.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ESTILOS PERSONALIZADOS --}}
<style>
.contact-support {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.rounded-4 {
    border-radius: 1rem !important;
}

.rounded-3 {
    border-radius: 0.75rem !important;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.display-5 {
    font-size: 2.25rem;
    font-weight: 700;
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}

.bg-opacity-5 {
    background-color: rgba(var(--bs-primary-rgb), 0.05) !important;
}

.form-control:focus, .form-select:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    border-color: #86b7fe;
}

.card {
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

@media (min-width: 768px) {
    .display-5 {
        font-size: 2.5rem;
    }
}

.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
}

/* Melhorias para a coluna de outros canais */
.fs-6 {
    font-size: 1rem !important;
}

.bg-light {
    background-color: #f8f9fa !important;
}
</style>

{{-- ÍCONES FONT AWESOME --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
{{-- ÍCONE DO WHATSAPP --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@endsection