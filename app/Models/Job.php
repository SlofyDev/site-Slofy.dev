<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title', 
        'description',
        'budget',
        'deadline',
        'status'
    ];

    protected $casts = [
        'deadline' => 'date',
        'budget' => 'decimal:2'
    ];

    // Empresa que publicou a vaga
    public function company()
    {
        return $this->belongsTo(User::class, 'company_id');
    }

    // Candidaturas para esta vaga
    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

    // Freelancers que se candidataram (através das applications)
    public function applicants()
    {
        return $this->hasManyThrough(
            User::class,
            JobApplication::class,
            'job_id', // Foreign key na tabela job_applications
            'id', // Foreign key na tabela users
            'id', // Local key na tabela jobs  
            'freelancer_id' // Local key na tabela job_applications
        );
    }

    /**
     * Accessor para nome da empresa (compatibilidade)
     */
    public function getCompanyNameAttribute()
    {
        return $this->company->company_name ?? $this->company->name ?? 'Empresa Confidencial';
    }

    /**
     * Accessor para salário (compatibilidade com budget) - CORRIGIDO
     */
    public function getSalaryAttribute()
    {
        // CORREÇÃO: Usar coalescência nula para tratar valores null
        $budget = $this->budget ?? 0.0;
        return 'R$ ' . number_format((float)$budget, 2, ',', '.');
    }

    /**
     * Accessor para budget formatado - NOVO
     */
    public function getBudgetFormattedAttribute()
    {
        $budget = $this->budget ?? 0.0;
        return 'R$ ' . number_format((float)$budget, 2, ',', '.');
    }
}