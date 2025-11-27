@extends('layouts.app')
@section('content')
<div class="card profile-card">
    <div class="card-body">
        <div class="profile-head">
            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : '/images/user-placeholder.png' }}" alt="avatar" class="avatar">
            <div>
                <h2>{{ $user->name }}</h2>
                <div class="muted">{{ $user->email }}</div>
            </div>
        </div>

        <hr>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Campos essenciais (nome, bio, skills) -->
            <div class="form-row">
                <label>Nome</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
            </div>

            <div class="form-row">
                <label>Bio</label>
                <textarea name="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
            </div>

            <div class="form-row">
                <label>Habilidades (separadas por vírgula)</label>
                <input type="text" name="skills" value="{{ old('skills', $user->skills) }}" class="form-control">
            </div>

            <div class="form-actions">
                <button class="btn primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection