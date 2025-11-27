@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="mb-3">Freelancers Disponíveis</h1>
        <p class="text-muted">Encontre os melhores talentos para seu projeto</p>
    </div>

    @if($freelancers->count() > 0)
        <div class="row g-4">
            @foreach($freelancers as $freelancer)
                <div class="col-md-6 col-lg-4">
                    <div class="freelancer-card">
                        <div class="freelancer-image">
                            <img 
                                src="{{ $freelancer->profile_photo_url }}"
                                alt="{{ $freelancer->name }}"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($freelancer->name) }}&background=7D5BBA&color=fff'">
                        </div>
                        <div class="freelancer-info">
                            <h3 class="freelancer-name">{{ $freelancer->name }}</h3>
                            <p class="freelancer-email">{{ $freelancer->email }}</p>
                            
                            @if($freelancer->skills)
                                <div class="freelancer-skills">
                                    @foreach(array_slice(explode(',', $freelancer->skills), 0, 3) as $skill)
                                        <span class="skill">{{ trim($skill) }}</span>
                                    @endforeach
                                </div>
                            @endif
                            
                            <a href="{{ route('freelancers.show', $freelancer->id) }}" class="btn-view">
                                Ver Perfil
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <div class="empty-icon">👥</div>
            <h3 class="mt-3">Nenhum freelancer cadastrado</h3>
            <p class="text-muted mb-4">Seja o primeiro a se cadastrar!</p>
            <a href="{{ route('register.freelancer') }}" class="btn primary">
                Cadastrar como Freelancer
            </a>
        </div>
    @endif
</div>
@endsection