<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar as 3 vagas mais recentes para a seção "Vagas em Destaque"
        $featured = Job::where('status', 'aberto')
                      ->with('company')
                      ->latest()
                      ->take(3)
                      ->get();

        return view('indexhome', compact('featured'));
    }
}