@extends('layouts.app')

@section('title', 'Sobre nós - Slofy.Dev')

@section('content')
<section class="sobre py-5 bg-light">
    <div class="container">
        {{-- CABEÇALHERO --}}
        <div class="text-center mb-5">
            <div class="mb-4">
                <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" 
                     style="width: 80px; height: 80px;">
                    <i class="fas fa-rocket text-primary fa-2x"></i>
                </div>
            </div>
            <h1 class="fw-bold text-primary display-4 mb-3">Sobre a Slofy.dev</h1>
            <p class="text-muted fs-5 mt-3 max-w-3xl mx-auto">
                Conectando talentos da tecnologia a oportunidades reais de trabalho.
            </p>
        </div>

        {{-- MISSÃO --}}
        <div class="row align-items-center mb-5 py-4">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="pe-lg-4">
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3">
                        <i class="fas fa-bullseye me-2"></i>Nossa Missão
                    </span>
                    <h2 class="fw-bold text-dark mb-4">Simplificar conexões na tecnologia</h2>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-dark mb-0">
                                A <strong class="text-primary">Slofy.dev</strong> nasceu com o objetivo de eliminar a burocracia e 
                                aproximar empresas e freelancers de forma rápida, eficiente e justa.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-dark mb-0">
                                Profissionais encontram projetos curtos, práticos e bem remunerados, enquanto 
                                empresas acessam especialistas prontos para entregar resultados.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="text-primary me-3">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-dark mb-0">
                                Foco na qualidade das conexões e na satisfação de ambos os lados.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="position-relative">
                    <img src="{{ asset('img/TeamWork.png') }}" 
                         alt="Equipe Slofy.Dev" 
                         class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute top-0 start-0 bg-primary text-white rounded-pill px-3 py-1 m-3 small">
                        <i class="fas fa-users me-1"></i> Trabalho em Equipe
                    </div>
                </div>
            </div>
        </div>

        {{-- VISÃO --}}
        <div class="row align-items-center mb-5 py-4">
            <div class="col-lg-6 text-center order-lg-1 order-2">
                <div class="position-relative">
                    <img src="{{ asset('img/Vision.png') }}" 
                         alt="Visão da Slofy.Dev" 
                         class="img-fluid rounded-4 shadow-lg">
                    <div class="position-absolute top-0 end-0 bg-success text-white rounded-pill px-3 py-1 m-3 small">
                        <i class="fas fa-eye me-1"></i> Visão de Futuro
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2 order-1">
                <div class="ps-lg-4">
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-3">
                        <i class="fas fa-binoculars me-2"></i>Nossa Visão
                    </span>
                    <h2 class="fw-bold text-dark mb-4">Liderar o mercado de freelancers de TI</h2>
                    <div class="d-flex mb-3">
                        <div class="text-success me-3">
                            <i class="fas fa-star fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-dark mb-0">
                                Ser a <strong>principal plataforma</strong> de freelancers de TI no Brasil, 
                                reconhecida pela transparência, qualidade e velocidade nas conexões.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="text-success me-3">
                            <i class="fas fa-star fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-dark mb-0">
                                Construir um ecossistema onde <strong>autonomia e confiança</strong> são os 
                                pilares de todas as relações profissionais.
                            </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="text-success me-3">
                            <i class="fas fa-star fa-lg"></i>
                        </div>
                        <div>
                            <p class="text-dark mb-0">
                                Expandir para novos mercados mantendo a <strong>excelência no serviço</strong>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- VALORES --}}
        <div class="valores py-5">
            <div class="text-center mb-5">
                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2 mb-3">
                    <i class="fas fa-heart me-2"></i>Nossos Valores
                </span>
                <h2 class="fw-bold text-dark mb-3">Princípios que nos guiam</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">
                    Valores fundamentais que orientam cada decisão e interação em nossa plataforma.
                </p>
            </div>
            
            <div class="row justify-content-center g-4">
                {{-- TRANSPARÊNCIA --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4 hover-card">
                        <div class="card-body text-center p-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                                 style="width: 70px; height: 70px;">
                                <i class="fas fa-eye text-primary fa-2x"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-3">Transparência</h4>
                            <p class="text-muted mb-0">
                                Relações diretas, claras e sem taxas abusivas. Acreditamos que a 
                                honestidade é a base de parcerias duradouras.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- AGILIDADE --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4 hover-card">
                        <div class="card-body text-center p-4">
                            <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                                 style="width: 70px; height: 70px;">
                                <i class="fas fa-bolt text-success fa-2x"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-3">Agilidade</h4>
                            <p class="text-muted mb-0">
                                Conexões rápidas entre empresa e freelancer, sem complicações. 
                                Velocidade que respeita a qualidade.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- VALORIZAÇÃO --}}
                <div class="col-lg-4 col-md-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4 hover-card">
                        <div class="card-body text-center p-4">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                                 style="width: 70px; height: 70px;">
                                <i class="fas fa-trophy text-warning fa-2x"></i>
                            </div>
                            <h4 class="fw-bold text-dark mb-3">Valorização</h4>
                            <p class="text-muted mb-0">
                                Trabalho bem feito e bem pago, como deve ser. Reconhecemos e 
                                recompensamos a excelência profissional.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA FINAL --}}
        <div class="text-center mt-5 pt-4">
            <div class="card border-0 bg-primary text-white rounded-4 shadow-lg">
                <div class="card-body py-5 px-4">
                    <h3 class="fw-bold mb-3">Pronto para fazer parte da nossa comunidade?</h3>
                    <p class="mb-4 opacity-75" style="color: white;">
                        Junte-se a milhares de profissionais e empresas que já transformaram 
                        suas conexões profissionais.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('register.freelancer') }}" class="btn btn-light btn-lg rounded-pill px-4">
                            <i class="fas fa-user-plus me-2"></i>Ser Freelancer
                        </a>
                        <a href="{{ route('register.empresa') }}" class="btn btn-outline-light btn-lg rounded-pill px-4">
                            <i class="fas fa-building me-2"></i>Cadastrar Empresa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ESTILOS PERSONALIZADOS --}}
<style>
.hover-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.hover-card:hover {
    transform: translateY(-5px);
    border-color: rgba(13, 110, 253, 0.1);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.max-w-3xl {
    max-width: 36rem;
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}

.rounded-4 {
    border-radius: 1rem !important;
}

.display-4 {
    font-size: 2.5rem;
    font-weight: 700;
}

@media (min-width: 768px) {
    .display-4 {
        font-size: 3rem;
    }
}

.shadow-lg {
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}
</style>

{{-- ÍCONES FONT AWESOME --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection