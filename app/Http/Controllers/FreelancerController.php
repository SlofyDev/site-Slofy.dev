<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FreelancerController extends Controller
{
    // Listagem de freelancers
    public function index()
    {
        $freelancers = User::where('role', 'freelancer')->get();
        return view('freelancers.index', compact('freelancers'));
    }

    // Visualizar perfil de freelancer
    public function show($id)
    {
        $freelancer = User::where('role', 'freelancer')->findOrFail($id);
        return view('freelancers.show', compact('freelancer'));
    }
}
