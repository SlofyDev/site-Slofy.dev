@extends('layouts.app')

@section('title', 'Política de Privacidade - Slofy.Dev')

@section('content')
<section class="privacy-policy py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                {{-- CABEÇALHO --}}
                <div class="text-center mb-5">
                    <div class="mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-shield-alt text-primary fa-2x"></i>
                        </div>
                    </div>
                    <h1 class="fw-bold text-primary display-5 mb-3">Política de Privacidade</h1>
                    <div class="d-flex align-items-center justify-content-center text-muted">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span>Última atualização: {{ date('d/m/Y') }}</span>
                    </div>
                </div>

                {{-- CARD PRINCIPAL --}}
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4 p-md-5">
                        {{-- INTRODUÇÃO --}}
                        <div class="mb-5">
                            <p class="lead text-dark mb-4">
                                A <strong class="text-primary">Slofy.dev</strong> valoriza a privacidade e a segurança dos dados de seus usuários. 
                                Esta Política de Privacidade explica como coletamos, usamos e protegemos as informações 
                                fornecidas por empresas e freelancers que utilizam nossa plataforma.
                            </p>
                        </div>

                        {{-- SEÇÕES --}}
                        <div class="privacy-sections">
                            {{-- SEÇÃO 1 --}}
                            <div class="privacy-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">1</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Coleta de Informações</h3>
                                        <p class="text-muted mb-0">
                                            Coletamos apenas os dados necessários para o funcionamento do site, como nome, 
                                            e-mail, senha, foto de perfil e informações profissionais. Esses dados são 
                                            fornecidos diretamente pelo usuário no momento do cadastro.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 2 --}}
                            <div class="privacy-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">2</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Uso das Informações</h3>
                                        <p class="text-muted mb-0">
                                            As informações são utilizadas para permitir a comunicação entre empresas e freelancers, 
                                            melhorar a experiência do usuário e garantir a segurança da plataforma.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 3 --}}
                            <div class="privacy-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">3</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Compartilhamento de Dados</h3>
                                        <p class="text-muted mb-0">
                                            Os dados não são compartilhados com terceiros, exceto quando necessário para 
                                            cumprir obrigações legais ou mediante consentimento do usuário.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 4 --}}
                            <div class="privacy-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">4</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Armazenamento e Segurança</h3>
                                        <p class="text-muted mb-0">
                                            Os dados são armazenados em servidores protegidos e acessíveis apenas por 
                                            pessoal autorizado. Empregamos medidas técnicas e administrativas para 
                                            evitar acessos não autorizados.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 5 --}}
                            <div class="privacy-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">5</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Direitos do Usuário</h3>
                                        <p class="text-muted mb-0">
                                            O usuário pode solicitar a exclusão ou alteração de suas informações pessoais 
                                            a qualquer momento através da área de perfil ou pelo e-mail 
                                            <strong class="text-primary">me.salva.bico@gmail.como</strong>.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 6 --}}
                            <div class="privacy-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">6</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Cookies</h3>
                                        <p class="text-muted mb-0">
                                            Utilizamos cookies apenas para fins funcionais e estatísticos. O usuário 
                                            pode desativar o uso de cookies em seu navegador, porém algumas partes 
                                            do site podem deixar de funcionar corretamente.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 7 --}}
                            <div class="privacy-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">7</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Alterações na Política</h3>
                                        <p class="text-muted mb-0">
                                            Esta política pode ser atualizada periodicamente. Quaisquer mudanças 
                                            relevantes serão comunicadas na própria plataforma.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 8 --}}
                            <div class="privacy-section">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">8</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Contato</h3>
                                        <p class="text-muted mb-0">
                                            Em caso de dúvidas sobre esta Política de Privacidade, entre em contato 
                                            pelo e-mail <strong class="text-primary">me.salva.bico@gmail.com</strong>.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- RODAPÉ DA POLÍTICA --}}
                        <div class="mt-5 pt-4 border-top">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5 class="fw-bold text-dark mb-2">Precisa de ajuda?</h5>
                                    <p class="text-muted mb-0 small">
                                        Nossa equipe está disponível para esclarecer qualquer dúvida sobre privacidade e proteção de dados.
                                    </p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <a href="mailto:privacidade@slofy.dev" class="btn btn-primary rounded-pill px-4">
                                        <i class="fas fa-envelope me-2"></i>Fale Conosco
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- INFORMAÇÃO ADICIONAL --}}
                <div class="text-center mt-4">
                    <p class="text-muted small">
                        <i class="fas fa-info-circle me-1"></i>
                        Esta política está em conformidade com a Lei Geral de Proteção de Dados (LGPD)
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ESTILOS PERSONALIZADOS --}}
<style>
.privacy-policy {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.rounded-4 {
    border-radius: 1rem !important;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.display-5 {
    font-size: 2.25rem;
    font-weight: 700;
}

.privacy-section {
    border-left: 3px solid #e9ecef;
    padding-left: 1.5rem;
    margin-left: 1.25rem;
}

.privacy-section:last-child {
    border-left-color: transparent;
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}

.lead {
    font-size: 1.1rem;
    font-weight: 400;
    line-height: 1.7;
}

@media (min-width: 768px) {
    .display-5 {
        font-size: 2.5rem;
    }
    
    .privacy-section {
        padding-left: 2rem;
        margin-left: 1.5rem;
    }
}

.card {
    transition: transform 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}
</style>

{{-- ÍCONES FONT AWESOME --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection