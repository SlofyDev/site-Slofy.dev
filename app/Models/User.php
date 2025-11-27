<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'bio',
        'skills',
        'gender',
        // CAMPOS CORPORATIVOS
        'company_name',
        'cnpj',
        'website',
        'phone',
        'business_hours',
        'company_description',
        'sector',
        // CAMPOS DE CONTATO
        'contact_email',
        'linkedin',
        'whatsapp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Gera avatar padrão com iniciais
     */
    public function getProfilePhotoUrlAttribute()
    {
        $name = urlencode($this->company_name ?? $this->name);
        
        if ($this->role === 'empresa') {
            return "https://ui-avatars.com/api/?name={$name}&background=005f6b&color=FFFFFF&size=200&bold=true";
        }

        $background = '008c9e'; // Ciano padrão
        if ($this->gender === 'feminino') {
            $background = '00b4cc'; // Ciano mais claro
        } elseif ($this->gender === 'masculino') {
            $background = '005f6b'; // Azul petróleo
        }

        return "https://ui-avatars.com/api/?name={$name}&background={$background}&color=FFFFFF&size=200";
    }

    public function isEmpresa()
    {
        return $this->role === 'empresa';
    }

    public function isFreelancer()
    {
        return $this->role === 'freelancer';
    }

    /**
     * Retorna o nome de exibição (empresa ou nome pessoal)
     */
    public function getDisplayNameAttribute()
    {
        return $this->company_name ?? $this->name;
    }

    /**
     * Formata CNPJ se existir
     */
    public function getFormattedCnpjAttribute()
    {
        if (!$this->cnpj) return null;

        $cnpj = preg_replace('/\D/', '', $this->cnpj);
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
    }

    /**
     * Vagas publicadas pela empresa
     */
    public function jobs()
    {
        return $this->hasMany(Job::class, 'company_id');
    }
}