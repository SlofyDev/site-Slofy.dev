@extends('layouts.app')

@section('title', 'Termos de Uso - Slofy.Dev')

@section('content')
<section class="terms-of-use py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                {{-- CABEÇALHO --}}
                <div class="text-center mb-5">
                    <div class="mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-file-contract text-primary fa-2x"></i>
                        </div>
                    </div>
                    <h1 class="fw-bold text-primary display-5 mb-3">Termos de Uso</h1>
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
                                Bem-vindo a <strong class="text-primary">Slofy.dev</strong>. Ao acessar ou utilizar nossa plataforma, 
                                você concorda com os seguintes Termos de Uso. Recomendamos que leia atentamente antes de prosseguir.
                            </p>
                        </div>

                        {{-- SEÇÕES --}}
                        <div class="terms-sections">
                            {{-- SEÇÃO 1 --}}
                            <div class="terms-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">1</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Objeto</h3>
                                        <p class="text-muted mb-0">
                                            A Slofy.dev é uma plataforma que conecta freelancers da área de tecnologia 
                                            com empresas que buscam profissionais para serviços pontuais e sem vínculo empregatício.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 2 --}}
                            <div class="terms-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">2</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Cadastro e Conta</h3>
                                        <p class="text-muted mb-0">
                                            O usuário deve fornecer informações verdadeiras, completas e atualizadas. 
                                            É proibido criar contas falsas, múltiplas contas com o mesmo objetivo ou 
                                            utilizar dados de terceiros sem autorização.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 3 --}}
                            <div class="terms-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">3</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Responsabilidade do Usuário</h3>
                                        <p class="text-muted mb-0">
                                            O usuário é responsável por suas ações dentro da plataforma, incluindo 
                                            informações publicadas, propostas enviadas e comunicações realizadas. 
                                            É vedado o uso do site para fins ilegais, ofensivos ou que violem direitos de terceiros.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 4 --}}
                            <div class="terms-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">4</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Responsabilidade da Plataforma</h3>
                                        <p class="text-muted mb-0">
                                            A Slofy.dev atua apenas como intermediadora entre empresas e freelancers. 
                                            Não se responsabiliza por pagamentos, prazos, qualidade de serviços prestados 
                                            ou qualquer relação contratual entre as partes.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 5 --}}
                            <div class="terms-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">5</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Pagamentos e Transações</h3>
                                        <p class="text-muted mb-0">
                                            Os valores negociados entre freelancer e empresa são de responsabilidade 
                                            exclusiva das partes. A plataforma não realiza retenção ou intermediação 
                                            financeira, salvo em casos futuros de integração com meios de pagamento.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 6 --}}
                            <div class="terms-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">6</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Propriedade Intelectual</h3>
                                        <p class="text-muted mb-0">
                                            Todo o conteúdo disponível na Slofy.dev, incluindo logotipos, design, 
                                            código e textos, pertence à plataforma e não pode ser copiado ou 
                                            reproduzido sem autorização expressa.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 7 --}}
                            <div class="terms-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">7</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Suspensão e Encerramento de Conta</h3>
                                        <p class="text-muted mb-0">
                                            A Slofy.dev reserva-se o direito de suspender ou encerrar contas que 
                                            violem estes Termos de Uso, a Política de Privacidade ou que causem 
                                            prejuízo a outros usuários.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 8 --}}
                            <div class="terms-section mb-5">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">8</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Modificações dos Termos</h3>
                                        <p class="text-muted mb-0">
                                            Os Termos de Uso podem ser atualizados periodicamente. As alterações 
                                            passam a valer a partir de sua publicação no site, sendo responsabilidade 
                                            do usuário consultá-las regularmente.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SEÇÃO 9 --}}
                            <div class="terms-section">
                                <div class="d-flex align-items-start mb-3">
                                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                                         style="width: 40px; height: 40px;">
                                        <span class="fw-bold">9</span>
                                    </div>
                                    <div>
                                        <h3 class="fw-bold text-dark mb-2">Foro e Legislação Aplicável</h3>
                                        <p class="text-muted mb-0">
                                            Em caso de disputas, fica eleito o foro da Comarca de São Paulo – SP, 
                                            com exclusão de qualquer outro, por mais privilegiado que seja.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ACEITAÇÃO FINAL --}}
                        <div class="mt-5 pt-4 border-top">
                            <div class="alert alert-primary border-0 rounded-3">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle fa-2x text-primary me-3"></i>
                                    <div>
                                        <h5 class="fw-bold text-dark mb-2">Aceitação dos Termos</h5>
                                        <p class="mb-0">
                                            Ao continuar utilizando o <strong class="text-primary">Slofy.dev</strong>, 
                                            você declara estar ciente e de acordo com todos os termos descritos acima.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- RODAPÉ --}}
                        <div class="mt-4 pt-3">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="fw-bold text-dark mb-2">Dúvidas sobre os termos?</h6>
                                    <p class="text-muted mb-0 small">
                                        Entre em contato com nossa equipe para esclarecimentos adicionais.
                                    </p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <a href="{{ route('contato') }}" class="btn btn-outline-primary rounded-pill px-4">
                                        <i class="fas fa-question-circle me-2"></i>Falar com Suporte
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- INFORMAÇÃO ADICIONAL --}}
                <div class="text-center mt-4">
                    <p class="text-muted small">
                        <i class="fas fa-balance-scale me-1"></i>
                        Estes termos estão em conformidade com a legislação brasileira vigente
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ESTILOS PERSONALIZADOS --}}
<style>
.terms-of-use {
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

.terms-section {
    border-left: 3px solid #e9ecef;
    padding-left: 1.5rem;
    margin-left: 1.25rem;
}

.terms-section:last-child {
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

.alert-primary {
    background-color: rgba(13, 110, 253, 0.05);
    border: 1px solid rgba(13, 110, 253, 0.1);
}

@media (min-width: 768px) {
    .display-5 {
        font-size: 2.5rem;
    }
    
    .terms-section {
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