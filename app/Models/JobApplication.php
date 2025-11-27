<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    

    use HasFactory;

    protected $fillable = [
        'job_id',
        'freelancer_id', 
        'proposal_text',
        'status'
    ];

    // Vaga relacionada
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    // Freelancer que se candidatou
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}