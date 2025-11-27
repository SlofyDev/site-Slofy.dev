@extends('layouts.app')

@section('title', 'Vagas disponíveis')

@section('content')
<section class="vagas py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">Vagas disponíveis</h1>
            <p class="text-muted mt-3">Encontre oportunidades rápidas e remuneradas na área de tecnologia.</p>
        </div>

        {{-- Barra de busca --}}
        <form action="{{ route('vagas.buscar') }}" method="GET" class="mb-4">
            <div class="row g-2 justify-content-center">
                <div class="col-md-6">
                    <input type="text" name="q" class="form-control" placeholder="Procure por cargo, tecnologia ou empresa..." value="{{ request('q') }}">
                </div>
                <div class="col-md-2">
                    <select name="tipo" class="form-select">
                        <option value="">Todos os tipos</option>
                        <option value="remoto" {{ request('tipo') == 'remoto' ? 'selected' : '' }}>Remoto</option>
                        <option value="presencial" {{ request('tipo') == 'presencial' ? 'selected' : '' }}>Presencial</option>
                        <option value="hibrido" {{ request('tipo') == 'hibrido' ? 'selected' : '' }}>Híbrido</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100" type="submit">Buscar</button>
                </div>
            </div>
        </form>

        {{-- Listagem de vagas --}}
        @if($vagas->isEmpty())
            <div class="text-center text-muted mt-5">
                <p>Nenhuma vaga encontrada no momento.</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($vagas as $vaga)
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 rounded-4">
                            <div class="card-body d-flex flex-column">
                                <h5 class="fw-semibold text-dark">{{ $vaga->titulo }}</h5>
                                <p class="text-muted small mb-1">
                                    <i class="bi bi-building"></i> {{ $vaga->empresa->nome ?? 'Empresa confidencial' }}
                                </p>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-geo-alt"></i> {{ ucfirst($vaga->tipo) }}
                                </p>
                                <p class="mb-3">{{ Str::limit($vaga->descricao, 100) }}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-success">R$ {{ number_format($vaga->valor, 2, ',', '.') }}</span>
                                    <a href="{{ route('vagas.show', $vaga->id) }}" class="btn btn-sm btn-outline-primary">
                                        Ver detalhes
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginação --}}
            <div class="mt-5 d-flex justify-content-center">
                {{ $vagas->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</section>
@endsection
