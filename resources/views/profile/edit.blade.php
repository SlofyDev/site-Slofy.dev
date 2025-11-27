@extends('layouts.app')

@section('title', 'Editar Perfil - Slofy.dev')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Cabeçalho Melhorado com Avatar -->
            <div class="text-center mb-5">
                <!-- Avatar do Usuário -->
                <div class="position-relative d-inline-block mb-4">
                    <div class="avatar-container position-relative">
                        <img src="{{ $user->profile_photo_url }}" 
                             alt="Foto de perfil" 
                             class="rounded-circle border-4 border-white shadow-lg"
                             style="width: 120px; height: 120px; object-fit: cover;"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=005f6b&color=FFFFFF&size=200'">
                        <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle p-2 border-3 border-white">
                            <i class="fas fa-camera text-white fa-sm"></i>
                        </div>
                    </div>
                </div>
                
                <h1 class="fw-bold text-dark display-6 mb-2">Editar Perfil</h1>
                <p class="text-muted fs-5">Atualize suas informações pessoais e profissionais</p>
                
                <!-- Badge do Tipo de Usuário -->
                <div class="mt-3">
                    @if($user->isEmpresa())
                        <span class="badge bg-success fs-6 px-3 py-2">
                            <i class="fas fa-building me-2"></i>Conta Empresarial
                        </span>
                    @else
                        <span class="badge bg-primary fs-6 px-3 py-2">
                            <i class="fas fa-user-tie me-2"></i>Conta Freelancer
                        </span>
                    @endif
                </div>
            </div>

            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Header do Card -->
                <div class="card-header bg-gradient-primary text-white py-4 border-0">
                    <div class="d-flex align-items-center">
                        <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3">
                            <i class="fas fa-user-cog fa-lg"></i>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-1">Configurações do Perfil</h3>
                            <p class="mb-0 opacity-75" style="color: white;">Gerencie suas informações pessoais e profissionais</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-5">
                    <!-- Alertas -->
                    @if(session('success'))
                        <div class="alert alert-success border-0 rounded-3 mb-4 d-flex align-items-center">
                            <i class="fas fa-check-circle me-3 fa-lg"></i>
                            <div class="fw-semibold">{{ session('success') }}</div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger border-0 rounded-3 mb-4 d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle me-3 fa-lg"></i>
                            <div class="fw-semibold">{{ session('error') }}</div>
                        </div>
                    @endif

                    <!-- Informações do Avatar Atual -->
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between p-4 bg-light rounded-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $user->profile_photo_url }}" 
                                         alt="Avatar atual" 
                                         class="rounded-circle me-3"
                                         style="width: 60px; height: 60px; object-fit: cover;"
                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=005f6b&color=FFFFFF&size=120'">
                                    <div>
                                        <h6 class="fw-bold mb-1">Avatar Atual</h6>
                                        <p class="text-muted mb-0 small">
                                            Seu avatar é gerado automaticamente com suas iniciais
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <span class="badge bg-info">
                                        <i class="fas fa-robot me-1"></i>Automático
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('profile.update') }}" class="needs-validation" novalidate>
                        @csrf
                        @method('PATCH')

                        <!-- Informações Básicas -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary bg-opacity-10 rounded p-2 me-3">
                                    <i class="fas fa-id-card text-primary fa-lg"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-0">Informações Básicas</h4>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="name" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fas fa-user me-2 text-primary"></i>Nome Completo
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" name="name" id="name" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('name', $user->name) }}" 
                                               placeholder="Seu nome completo" required>
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="fas fa-info-circle me-1"></i>Este nome será usado para gerar seu avatar
                                    </div>
                                    @error('name')
                                        <div class="text-danger small mt-2 d-flex align-items-center">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="email" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fas fa-envelope me-2 text-primary"></i>E-mail
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" name="email" id="email" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('email', $user->email) }}" 
                                               placeholder="seu@email.com" required>
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-2 d-flex align-items-center">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if($user->isFreelancer())
                        <!-- Campos para Freelancer -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-success bg-opacity-10 rounded p-2 me-3">
                                    <i class="fas fa-code text-success fa-lg"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-0">Perfil Profissional</h4>
                            </div>
                            
                            <div class="mb-4">
                                <label for="bio" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-file-alt me-2 text-primary"></i>Biografia Profissional
                                </label>
                                <div class="position-relative">
                                    <textarea name="bio" id="bio" rows="5"
                                              class="form-control rounded-3 border-0 bg-light py-3"
                                              placeholder="Descreva suas experiências, especialidades e objetivos profissionais...">{{ old('bio', $user->bio) }}</textarea>
                                    <div class="position-absolute top-0 end-0 mt-3 me-3">
                                        <small class="text-muted"><span id="bio-counter">{{ strlen(old('bio', $user->bio ?? '')) }}</span>/1000</small>
                                    </div>
                                </div>
                                @error('bio')
                                    <div class="text-danger small mt-2 d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="skills" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-star me-2 text-warning"></i>Habilidades & Competências
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="fas fa-tools text-muted"></i>
                                    </span>
                                    <input type="text" name="skills" id="skills" 
                                           class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                           value="{{ old('skills', $user->skills) }}"
                                           placeholder="Ex: PHP, JavaScript, React, Node.js, Design UI/UX">
                                </div>
                                <div class="form-text text-muted mt-2">
                                    <i class="fas fa-info-circle me-1"></i>Separe as habilidades com vírgula
                                </div>
                                @error('skills')
                                    <div class="text-danger small mt-2 d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Contato Freelancer -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-info bg-opacity-10 rounded p-2 me-3">
                                    <i class="fas fa-address-book text-info fa-lg"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-0">Informações de Contato</h4>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="phone" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fas fa-phone me-2 text-primary"></i>Telefone
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-phone text-muted"></i>
                                        </span>
                                        <input type="text" name="phone" id="phone" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('phone', $user->phone) }}"
                                               placeholder="(11) 99999-9999">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="whatsapp" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fab fa-whatsapp me-2 text-success"></i>WhatsApp
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fab fa-whatsapp text-muted"></i>
                                        </span>
                                        <input type="text" name="whatsapp" id="whatsapp" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('whatsapp', $user->whatsapp) }}"
                                               placeholder="(11) 99999-9999">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="contact_email" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fas fa-envelope me-2 text-primary"></i>E-mail para Contato
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" name="contact_email" id="contact_email" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('contact_email', $user->contact_email) }}"
                                               placeholder="contato@seuemail.com">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="linkedin" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fab fa-linkedin me-2 text-primary"></i>LinkedIn
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fab fa-linkedin text-muted"></i>
                                        </span>
                                        <input type="url" name="linkedin" id="linkedin" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('linkedin', $user->linkedin) }}"
                                               placeholder="https://linkedin.com/in/seu-perfil">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($user->isEmpresa())
                        <!-- Campos para Empresa -->
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-warning bg-opacity-10 rounded p-2 me-3">
                                    <i class="fas fa-building text-warning fa-lg"></i>
                                </div>
                                <h4 class="fw-bold text-dark mb-0">Dados da Empresa</h4>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="company_name" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fas fa-building me-2 text-primary"></i>Nome da Empresa
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-building text-muted"></i>
                                        </span>
                                        <input type="text" name="company_name" id="company_name" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('company_name', $user->company_name) }}"
                                               placeholder="Razão Social da Empresa">
                                    </div>
                                    <div class="form-text text-muted mt-2">
                                        <i class="fas fa-info-circle me-1"></i>Este nome será usado para gerar o avatar da empresa
                                    </div>
                                    @error('company_name')
                                        <div class="text-danger small mt-2 d-flex align-items-center">
                                            <i class="fas fa-exclamation-circle me-2"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="cnpj" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fas fa-id-card me-2 text-primary"></i>CNPJ
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-id-card text-muted"></i>
                                        </span>
                                        <input type="text" name="cnpj" id="cnpj" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('cnpj', $user->cnpj) }}"
                                               placeholder="00.000.000/0000-00">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="sector" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fas fa-industry me-2 text-primary"></i>Setor de Atuação
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-industry text-muted"></i>
                                        </span>
                                        <input type="text" name="sector" id="sector" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('sector', $user->sector) }}"
                                               placeholder="Tecnologia, Consultoria, etc.">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="website" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fas fa-globe me-2 text-primary"></i>Site
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-globe text-muted"></i>
                                        </span>
                                        <input type="url" name="website" id="website" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('website', $user->website) }}"
                                               placeholder="https://empresa.com">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="phone" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fas fa-phone me-2 text-primary"></i>Telefone Comercial
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-phone text-muted"></i>
                                        </span>
                                        <input type="text" name="phone" id="phone" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('phone', $user->phone) }}"
                                               placeholder="(11) 3333-3333">
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="business_hours" class="form-label fw-semibold text-dark mb-2">
                                        <i class="fas fa-clock me-2 text-primary"></i>Horário de Funcionamento
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-0">
                                            <i class="fas fa-clock text-muted"></i>
                                        </span>
                                        <input type="text" name="business_hours" id="business_hours" 
                                               class="form-control rounded-3 border-0 bg-light py-3 ps-0"
                                               value="{{ old('business_hours', $user->business_hours) }}"
                                               placeholder="Segunda a Sexta, 9h às 18h">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="company_description" class="form-label fw-semibold text-dark mb-2">
                                    <i class="fas fa-file-alt me-2 text-primary"></i>Descrição da Empresa
                                </label>
                                <div class="position-relative">
                                    <textarea name="company_description" id="company_description" rows="5"
                                              class="form-control rounded-3 border-0 bg-light py-3"
                                              placeholder="Descreva sua empresa, missão, valores e atuação no mercado...">{{ old('company_description', $user->company_description) }}</textarea>
                                    <div class="position-absolute top-0 end-0 mt-3 me-3">
                                        <small class="text-muted"><span id="company_description-counter">{{ strlen(old('company_description', $user->company_description ?? '')) }}</span>/1000</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Botões de Ação -->
                        <div class="d-flex gap-3 justify-content-end pt-4 border-top">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary rounded-3 px-5 py-3 fw-semibold">
                                <i class="fas fa-arrow-left me-2"></i>Voltar
                            </a>
                            <button type="submit" class="btn btn-primary rounded-3 px-5 py-3 fw-semibold">
                                <i class="fas fa-save me-2"></i>Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos Adicionais -->
<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%) !important;
}

.card-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
}

.avatar-container {
    transition: transform 0.3s ease;
}

.avatar-container:hover {
    transform: scale(1.05);
}

.input-group-text {
    transition: all 0.3s ease;
}

.form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    border-color: #86b7fe;
}

.form-control {
    transition: all 0.3s ease;
}

.btn {
    transition: all 0.3s ease;
    font-weight: 600;
}

.btn-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
}

.alert {
    backdrop-filter: blur(10px);
    border: none;
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}

/* Animações suaves */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

/* Responsividade */
@media (max-width: 768px) {
    .container.py-5 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }
    
    .card-body.p-5 {
        padding: 2rem !important;
    }
    
    .display-6 {
        font-size: 2rem !important;
    }
    
    .avatar-container img {
        width: 100px !important;
        height: 100px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Atualização em tempo real do preview do avatar
    const nameInput = document.getElementById('name');
    if (nameInput) {
        nameInput.addEventListener('input', function() {
            const name = this.value || '{{ $user->name }}';
            const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=005f6b&color=FFFFFF&size=200`;
            
            // Atualiza todas as imagens de avatar na página
            document.querySelectorAll('img[alt="Foto de perfil"], img[alt="Avatar atual"]').forEach(img => {
                img.src = avatarUrl;
            });
        });
    }

    // Contador de caracteres para bio (Freelancer)
    const bioTextarea = document.getElementById('bio');
    const bioCounter = document.getElementById('bio-counter');
    
    if (bioTextarea && bioCounter) {
        // Atualiza contador inicial
        bioCounter.textContent = bioTextarea.value.length;
        
        // Atualiza enquanto digita
        bioTextarea.addEventListener('input', function() {
            bioCounter.textContent = this.value.length;
        });
    }

    // Contador para descrição da empresa (Empresa)
    const companyDescTextarea = document.getElementById('company_description');
    const companyDescCounter = document.getElementById('company_description-counter');
    
    if (companyDescTextarea && companyDescCounter) {
        // Atualiza contador inicial
        companyDescCounter.textContent = companyDescTextarea.value.length;
        
        // Atualiza enquanto digita
        companyDescTextarea.addEventListener('input', function() {
            companyDescCounter.textContent = this.value.length;
        });
    }
});
</script>
@endsection