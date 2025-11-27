@extends('layouts.app')

@section('title', $freelancer->name . ' - Perfil')

@section('content')
<div class="container py-5">
    <div class="profile-container">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-image">
                <img 
                    src="{{ $freelancer->profile_photo_url }}"
                    alt="{{ $freelancer->name }}"
                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($freelancer->name) }}&background=7D5BBA&color=fff&size=200'">
            </div>
            <div class="profile-info">
                <h1>{{ $freelancer->name }}</h1>
                <p class="profile-email">{{ $freelancer->email }}</p>
                @if($freelancer->role)
                    <p class="profile-role">{{ $freelancer->role }}</p>
                @endif
            </div>
        </div>

        <!-- Bio Section -->
        <div class="profile-section">
            <h2>Biografia</h2>
            <div class="section-content">
                <p>{{ $freelancer->bio ?? 'Este freelancer ainda não adicionou uma biografia.' }}</p>
            </div>
        </div>

        <!-- Skills Section -->
        <div class="profile-section">
            <h2>Habilidades</h2>
            <div class="section-content">
                @if(!empty($freelancer->skills))
                    <div class="skills-list">
                        @foreach(explode(',', $freelancer->skills) as $skill)
                            <span class="skill-tag">{{ trim($skill) }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Nenhuma habilidade cadastrada.</p>
                @endif
            </div>
        </div>

        <!-- Contact Card -->
        <div class="profile-section">
            <h2>Contato</h2>
            <div class="section-content">
                <div class="contact-card">
                    @if($freelancer->contact_email)
                        <div class="contact-item">
                            <div class="contact-icon">📧</div>
                            <div class="contact-info">
                                <strong>E-mail</strong>
                                <a href="mailto:{{ $freelancer->contact_email }}">{{ $freelancer->contact_email }}</a>
                            </div>
                        </div>
                    @endif

                    @if($freelancer->phone)
                        <div class="contact-item">
                            <div class="contact-icon">📱</div>
                            <div class="contact-info">
                                <strong>Telefone</strong>
                                <a href="tel:{{ $freelancer->phone }}">{{ $freelancer->phone }}</a>
                            </div>
                        </div>
                    @endif

                    @if($freelancer->whatsapp)
                        <div class="contact-item">
                            <div class="contact-icon">💚</div>
                            <div class="contact-info">
                                <strong>WhatsApp</strong>
                                <a href="https://wa.me/55{{ preg_replace('/\D/', '', $freelancer->whatsapp) }}" target="_blank">
                                    {{ $freelancer->whatsapp }}
                                </a>
                            </div>
                        </div>
                    @endif

                    @if($freelancer->linkedin)
                        <div class="contact-item">
                            <div class="contact-icon">💼</div>
                            <div class="contact-info">
                                <strong>LinkedIn</strong>
                                <a href="{{ $freelancer->linkedin }}" target="_blank">Ver perfil</a>
                            </div>
                        </div>
                    @endif

                    @if(!$freelancer->contact_email && !$freelancer->phone && !$freelancer->whatsapp && !$freelancer->linkedin)
                        <p class="text-muted">Informações de contato não disponíveis.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection