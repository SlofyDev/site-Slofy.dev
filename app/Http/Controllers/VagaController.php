<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaga;
use App\Models\Job;

class VagaController extends Controller
{
    public function index()
    {
        // Use o modelo correto (Job) em vez de Vaga se for o caso
        $vagas = Job::where('status', 'aberto')->latest()->get();
        return view('vagas', compact('vagas'));
    }

    // Busca de vagas
    public function buscar(Request $request)
    {
        $query = $request->input('q');
        $tipo  = $request->input('tipo');

        $vagas = Job::where('status', 'aberto');

        if ($query) {
            $vagas->where(function($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            });
        }

        if ($tipo) {
            $vagas->where('tipo', $tipo);
        }

        $vagas = $vagas->latest()->get();

        return view('vagas', compact('vagas'));
    }
}