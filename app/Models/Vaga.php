<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company_name',
        'location',
        'description',
        'salary',
        'type',
        'featured'
    ];

    public function index()
    {
        $featured = [];
        return view('indexHome', compact('featured'));
    }
}
