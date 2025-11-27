<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = User::where('role', 'empresa')->get();
        return view('empresas.index', compact('empresas'));
    }
}
