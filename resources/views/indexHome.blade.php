@extends('layouts.app')

@section('content')
<div class="hero">
    <div class="hero-left">
        <h1>Encontre ou publique vagas de TI com rapidez.</h1>
        <p>Conectamos freelancers qualificados a empresas que precisam de tecnologia. Plataforma segura, prática e objetiva.</p>

        <div class="cta-row">
            <a href="{{ route('register.freelancer') }}" class="btn primary">Quero ser Freelancer</a>
            <a href="{{ route('register.empresa') }}" class="btn secondary">Sou Empresa</a>
        </div>
    </div>

    <div class="hero-right">
        <div class="card quick-stats">
            <div class="card-body">
                <h3>Vagas em Destaque</h3>
                <ul class="list-compact">
                    @forelse($featured as $vaga)
                        <li>
                            <strong>{{ $vaga->title }}</strong>
                            <div class="muted">{{ $vaga->company->company_name ?? $vaga->company->name ?? 'Empresa Confidencial' }} • R$ {{ number_format($vaga->budget, 2, ',', '.') }}</div>
                        </li>
                    @empty
                        <li class="muted">Nenhuma vaga em destaque no momento.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
.hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 50px;
    padding: 6rem 10%;
    background: linear-gradient(180deg, var(--color-bg-light) 0%, var(--color-silver-light) 100%);
    min-height: 80vh;
}

.hero-left {
    flex: 1;
}

.hero-left h1 {
    font-size: 2.75rem;
    background: linear-gradient(135deg, var(--color-primary-purple), var(--color-purple-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
}

.hero-left p {
    color: var(--text-muted);
    font-size: 1.1rem;
    line-height: 1.6;
}

.cta-row {
    display: flex;
    gap: 20px;
    margin-top: 2rem;
}

.hero-right {
    flex: 1;
}

.hero-right .card {
    transform: translateY(0);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(139, 95, 191, 0.1);
}

.hero-right .card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 30px rgba(139, 95, 191, 0.15);
}

.list-compact {
    list-style: none;
    padding: 0;
    margin: 0;
}

.list-compact li {
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid var(--border-light);
}

.list-compact .muted {
    color: var(--text-muted);
    font-size: 0.9rem;
}
</style>
@endsection