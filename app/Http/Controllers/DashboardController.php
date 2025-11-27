<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Job;
use App\Models\JobApplication;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isEmpresa()) {
            // Para empresa: buscar vagas da empresa logada
            $vagas = Job::where('company_id', $user->id)
                ->withCount('applications')
                ->latest()
                ->get();

            return view('dashboard.dashboard_empresa', compact('user', 'vagas'));
        } else {
            // Para freelancer: buscar todas as vagas ativas E calcular estatísticas
            $vagas = Job::where('status', 'aberto')
                ->orWhere('status', 'ativa')
                ->orWhere('status', 'publicada')
                ->with('company')
                ->latest()
                ->get();

            // CALCULAR ESTATÍSTICAS DO FREELANCER
            $candidaturasAceitas = JobApplication::where('freelancer_id', $user->id)
                ->where('status', 'aceito')
                ->count();

            $trabalhosConcluidos = JobApplication::where('freelancer_id', $user->id)
                ->where('status', 'aceito')
                ->whereHas('job', function($query) {
                    $query->where('status', 'fechado');
                })
                ->count();

            $totalCandidaturas = JobApplication::where('freelancer_id', $user->id)->count();

            return view('dashboard.dashboard_freelancer', compact(
                'user', 
                'vagas', 
                'candidaturasAceitas', 
                'trabalhosConcluidos',
                'totalCandidaturas'
            ));
        }
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,

            // Campos de freelancer
            'bio' => 'nullable|string|max:1000',
            'skills' => 'nullable|string|max:500',

            // Campos de empresa
            'company_name' => 'nullable|string|max:255',
            'cnpj' => 'nullable|string|max:20',
            'sector' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'business_hours' => 'nullable|string|max:255',
            'company_description' => 'nullable|string|max:1000',

            // Campos de contato
            'contact_email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'linkedin' => 'nullable|url|max:255',
        ]);

        try {
            // Atualizar campos básicos
            $user->name = $validated['name'];
            $user->email = $validated['email'];

            // Atualizar campos de freelancer
            if ($user->isFreelancer()) {
                $user->bio = $validated['bio'] ?? null;
                $user->skills = $validated['skills'] ?? null;
                $user->contact_email = $validated['contact_email'] ?? null;
                $user->phone = $validated['phone'] ?? null;
                $user->whatsapp = $validated['whatsapp'] ?? null;
                $user->linkedin = $validated['linkedin'] ?? null;
            }

            // Atualizar campos de empresa
            if ($user->isEmpresa()) {
                $user->company_name = $validated['company_name'] ?? null;
                $user->cnpj = $validated['cnpj'] ?? null;
                $user->sector = $validated['sector'] ?? null;
                $user->website = $validated['website'] ?? null;
                $user->business_hours = $validated['business_hours'] ?? null;
                $user->company_description = $validated['company_description'] ?? null;
                $user->phone = $validated['phone'] ?? null;
            }

            $user->save();

            return redirect()->route('profile.edit')->with('success', 'Perfil atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar perfil: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        return $this->updateProfile($request);
    }
}