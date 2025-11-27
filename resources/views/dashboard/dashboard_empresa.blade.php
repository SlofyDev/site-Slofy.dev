@extends('layouts.app')
@section('title', 'Painel da Empresa')
@section('content')
<div class="container py-4">
    <div class="row">
        {{-- COLUNA PRINCIPAL --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="fw-semibold text-primary mb-0">Painel da Empresa</h3>
                        <div class="badge bg-success fs-6">
                            <i class="fas fa-building me-1"></i> Conta Empresarial
                        </div>
                    </div>
                    <p class="text-muted mb-3">Gerencie suas vagas e acompanhe candidatos interessados.</p>
                    
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('vagas.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Cadastrar Nova Vaga
                        </a>
                        <a href="{{ route('vagas.manage') }}" class="btn btn-outline-primary">
                            <i class="fas fa-tasks me-2"></i>Gerenciar Candidaturas
                        </a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-edit me-2"></i>Editar Perfil
                        </a>
                    </div>
                </div>
            </div>

            {{-- ESTATÍSTICAS RÁPIDAS --}}
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card border-0 bg-primary text-white rounded-4">
                        <div class="card-body text-center">
                            <h4 class="fw-bold">{{ $vagas->count() }}</h4>
                            <p class="mb-0" style="color: white;">Vagas Ativas</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @php
                        $totalCandidaturas = 0;
                        foreach($vagas as $vaga) {
                            $totalCandidaturas += $vaga->applications_count ?? 0;
                        }
                    @endphp
                    <div class="card border-0 bg-success text-white rounded-4">
                        <div class="card-body text-center">
                            <h4 class="fw-bold">{{ $totalCandidaturas }}</h4>
                            <p class="mb-0" style="color: white;">Candidaturas</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 bg-info text-white rounded-4">
                        <div class="card-body text-center">
                            <h4 class="fw-bold">{{ $vagas->where('status', 'aberto')->count() }}</h4>
                            <p class="mb-0" style="color: white;">Vagas Abertas</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- VAGAS RECENTES --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h4 class="fw-semibold mb-3">Suas Vagas Publicadas</h4>
                </div>
                <div class="card-body">
                    @if($vagas->count())
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Vaga</th>
                                        <th>Candidaturas</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vagas as $vaga)
                                        <tr>
                                            <td>
                                                <strong>{{ $vaga->title }}</strong>
                                                <br>
                                                <small class="text-muted">Criada em: {{ $vaga->created_at->format('d/m/Y') }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ ($vaga->applications_count ?? 0) > 0 ? 'success' : 'secondary' }}">
                                                    {{ $vaga->applications_count ?? 0 }} candidatura(s)
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $vaga->status == 'aberto' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($vaga->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('vagas.show', $vaga->id) }}" class="btn btn-outline-secondary" title="Ver vaga">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('vagas.manage') }}" class="btn btn-outline-primary" title="Gerenciar candidaturas">
                                                        <i class="fas fa-users"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Nenhuma vaga publicada</h5>
                            <p class="text-muted mb-3">Comece criando sua primeira vaga para encontrar talentos.</p>
                            <a href="{{ route('vagas.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Criar Primeira Vaga
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- SIDEBAR - PERFIL EMPRESARIAL --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 20px;">
                <div class="card-body text-center">
                    {{-- LOGO/AVATAR DA EMPRESA --}}
                    <div class="mb-3">
                        <img src="{{ $user->profile_photo_url }}" alt="Logo da empresa"
                             style="width:120px;height:120px;object-fit:cover;border-radius:16px;border:3px solid #e6e6e6;">
                    </div>

                    {{-- NOME DA EMPRESA EM DESTAQUE --}}
                    <h4 class="fw-bold text-primary mb-2">{{ $user->company_name ?? $user->name }}</h4>
                    
                    {{-- SETOR/ÁREA DE ATUAÇÃO --}}
                    @if($user->sector)
                        <span class="badge bg-light text-dark mb-3">{{ $user->sector }}</span>
                    @endif

                    {{-- INFORMAÇÕES CORPORATIVAS --}}
                    <div class="text-start mt-4">
                        {{-- RESPONSÁVEL --}}
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-user text-muted me-2" style="width: 20px;"></i>
                            <div>
                                <small class="text-muted d-block">Responsável</small>
                                <strong>{{ $user->name }}</strong>
                            </div>
                        </div>

                        {{-- CONTATO --}}
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-envelope text-muted me-2" style="width: 20px;"></i>
                            <div>
                                <small class="text-muted d-block">Email</small>
                                <strong>{{ $user->email }}</strong>
                            </div>
                        </div>

                        @if($user->phone)
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-phone text-muted me-2" style="width: 20px;"></i>
                            <div>
                                <small class="text-muted d-block">Telefone</small>
                                <strong>{{ $user->phone }}</strong>
                            </div>
                        </div>
                        @endif

                        @if($user->website)
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-globe text-muted me-2" style="width: 20px;"></i>
                            <div>
                                <small class="text-muted d-block">Site</small>
                                <a href="{{ $user->website }}" target="_blank" class="text-decoration-none">
                                    <strong>{{ $user->website }}</strong>
                                </a>
                            </div>
                        </div>
                        @endif

                        @if($user->cnpj)
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-id-card text-muted me-2" style="width: 20px;"></i>
                            <div>
                                <small class="text-muted d-block">CNPJ</small>
                                <strong>{{ $user->cnpj }}</strong>
                            </div>
                        </div>
                        @endif
                    </div>

                    <hr class="my-4">

                    {{-- AÇÕES RÁPIDAS --}}
                    <div class="d-grid gap-2">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-edit me-2"></i>Editar Perfil Empresarial
                        </a>
                        <a href="{{ route('vagas.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-2"></i>Nova Vaga
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ÍCONES FONT AWESOME --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
.sticky-top {
    position: -webkit-sticky;
    position: sticky;
    z-index: 1020;
}
.table th {
    border-top: none;
    font-weight: 600;
    color: #6c757d;
}
</style>
@endsection