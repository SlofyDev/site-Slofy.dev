<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    const STATUS_PENDING = 'pendente';
    const STATUS_ACCEPTED = 'aceito';
    const STATUS_REJECTED = 'rejeitado';
    const STATUS_OPEN = 'aberto';
    const STATUS_IN_PROGRESS = 'em andamento';
    const STATUS_CLOSED = 'fechado';

    public function __construct()
    {
        $this->middleware('auth');
        
        // Compartilha métodos com todas as views
        view()->share('getStatusColor', [$this, 'getStatusColor']);
        view()->share('getStatusIcon', [$this, 'getStatusIcon']);
    }

    // ------------------------------
    // Criação de trabalhos (empresa)
    // ------------------------------
    public function create(): View|RedirectResponse
    {
        $user = Auth::user();
        
        if ($user->role !== 'empresa') {
            return redirect()->route('dashboard')->with('error', '❌ Acesso permitido apenas para empresas.');
        }

        return view('jobs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        if ($user->role !== 'empresa') {
            return redirect()->route('dashboard')->with('error', '❌ Acesso permitido apenas para empresas.');
        }

        // VALIDAÇÕES CORRIGIDAS - MAIS FLEXÍVEIS
        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10|max:2000',
            'budget' => 'required|numeric|min:1|max:9999999',
            'deadline' => 'required|date|after:today',
        ], [
            'title.required' => 'O título da vaga é obrigatório',
            'title.min' => 'O título deve ter pelo menos 5 caracteres',
            'description.required' => 'A descrição da vaga é obrigatória',
            'description.min' => 'A descrição deve ter pelo menos 10 caracteres',
            'budget.required' => 'O orçamento é obrigatório',
            'budget.min' => 'O orçamento deve ser maior que zero',
            'deadline.required' => 'O prazo de entrega é obrigatório',
            'deadline.after' => 'O prazo deve ser a partir de amanhã',
        ]);

        try {
            Job::create([
                'company_id' => $user->id,
                'title' => $request->title,
                'description' => $request->description,
                'budget' => $request->budget,
                'deadline' => $request->deadline,
                'status' => self::STATUS_OPEN,
            ]);

            return redirect()->route('vagas.manage')->with('success', '🎉 Vaga criada com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Erro ao criar vaga: ' . $e->getMessage());
        }
    }

    // ------------------------------
    // Listagem de trabalhos abertos (freelancer)
    // ------------------------------
    public function index(): View|RedirectResponse
    {
        $user = Auth::user();
        
        // Se for empresa, redireciona para o dashboard
        if ($user->role === 'empresa') {
            return redirect()->route('dashboard')->with('error', '❌ Acesso permitido apenas para freelancers.');
        }

        // BUSCA APENAS VAGAS ABERTAS DE TODAS AS EMPRESAS
        $jobs = Job::where('status', self::STATUS_OPEN)
                   ->with('company')
                   ->orderBy('created_at', 'desc')
                   ->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    // ------------------------------
    // Aplicar para um trabalho (freelancer)
    // ------------------------------
    public function apply(Request $request, Job $job): RedirectResponse
    {
        $user = Auth::user();
        
        if ($user->role !== 'freelancer') {
            return redirect()->route('dashboard')->with('error', '❌ Acesso permitido apenas para freelancers.');
        }

        if ($job->status !== self::STATUS_OPEN) {
            return redirect()->back()->with('error', '❌ Não é possível aplicar para vagas fechadas.');
        }

        // Verifica se já se candidatou
        $exists = JobApplication::where('job_id', $job->id)
            ->where('freelancer_id', $user->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', '⚠️ Você já se candidatou para esta vaga.');
        }

        $request->validate([
            'proposal_text' => 'required|string|min:10|max:1000',
        ], [
            'proposal_text.required' => 'A proposta é obrigatória',
            'proposal_text.min' => 'A proposta deve ter pelo menos 10 caracteres',
        ]);

        try {
            JobApplication::create([
                'job_id' => $job->id,
                'freelancer_id' => $user->id,
                'proposal_text' => $request->proposal_text,
                'status' => self::STATUS_PENDING,
            ]);

            return redirect()->back()->with('success', '🎉 Candidatura enviada com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Erro ao enviar candidatura: ' . $e->getMessage());
        }
    }

    // ------------------------------
    // Gerenciar trabalhos e propostas (empresa)
    // ------------------------------
    public function manage(): View|RedirectResponse
    {
        $user = Auth::user();
        
        if ($user->role !== 'empresa') {
            if ($user->role === 'freelancer') {
                return redirect()->route('applications.index')->with('error', '❌ Acesso restrito! Esta área é apenas para empresas. Como freelancer, você pode ver suas candidaturas abaixo.');
            }
            return redirect()->route('dashboard')->with('error', '❌ Acesso restrito! Esta área é apenas para empresas cadastradas.');
        }

        // CARREGA AS VAGAS DA EMPRESA COM CANDIDATURAS E FREELANCERS
        $jobs = Job::where('company_id', $user->id)
            ->with(['applications.freelancer'])
            ->withCount('applications')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('jobs.manage', compact('jobs', 'user'));
    }

    public function updateApplicationStatus(Request $request, JobApplication $application): RedirectResponse
    {
        $user = Auth::user();
        
        if ($user->role !== 'empresa') {
            return redirect()->route('dashboard')->with('error', '❌ Acesso negado.');
        }

        // Verifica se a aplicação pertence a uma vaga da empresa
        $job = Job::where('id', $application->job_id)
                  ->where('company_id', $user->id)
                  ->first();

        if (!$job) {
            return redirect()->route('vagas.manage')->with('error', '❌ Candidatura não encontrada.');
        }

        $request->validate([
            'status' => 'required|in:' . implode(',', [self::STATUS_PENDING, self::STATUS_ACCEPTED, self::STATUS_REJECTED]),
        ]);

        try {
            DB::transaction(function () use ($application, $request, $job) {
                $application->status = $request->status;
                $application->save();

                if ($request->status === self::STATUS_ACCEPTED) {
                    $job->status = self::STATUS_IN_PROGRESS;
                    $job->save();

                    // Rejeitar automaticamente outras propostas para esta vaga
                    JobApplication::where('job_id', $job->id)
                        ->where('id', '<>', $application->id)
                        ->update(['status' => self::STATUS_REJECTED]);
                }
            });

            $statusMessages = [
                self::STATUS_ACCEPTED => '✅ Candidatura aceita com sucesso!',
                self::STATUS_REJECTED => '❌ Candidatura rejeitada.',
                self::STATUS_PENDING => '🔄 Status alterado para pendente.'
            ];

            return redirect()->back()->with('success', $statusMessages[$request->status]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Erro ao atualizar status: ' . $e->getMessage());
        }
    }

    // ------------------------------
    // Freelancer vê suas próprias propostas
    // ------------------------------
    public function myApplications(): View|RedirectResponse
    {
        $user = Auth::user();
        
        if ($user->role !== 'freelancer') {
            return redirect()->route('dashboard')->with('error', '❌ Acesso permitido apenas para freelancers.');
        }

        $applications = JobApplication::where('freelancer_id', $user->id)
            ->with('job.company')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('jobs.my-applications', compact('applications'));
    }

    // ------------------------------
    // Detalhes de um trabalho
    // ------------------------------
    public function show(Job $job): View
    {
        $user = Auth::user();
        
        // Carrega relacionamentos para a view
        $job->load('company', 'applications');
        
        return view('jobs.show', compact('job', 'user'));
    }

    // ------------------------------
    // EDITAR VAGA (NOVOS MÉTODOS)
    // ------------------------------
    public function edit($id): View|RedirectResponse
    {
        $user = Auth::user();
        
        if ($user->role !== 'empresa') {
            return redirect()->route('dashboard')->with('error', '❌ Acesso permitido apenas para empresas.');
        }

        $job = Job::where('id', $id)
                  ->where('company_id', $user->id)
                  ->firstOrFail();

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $user = Auth::user();
        
        if ($user->role !== 'empresa') {
            return redirect()->route('dashboard')->with('error', '❌ Acesso permitido apenas para empresas.');
        }

        $job = Job::where('id', $id)
                  ->where('company_id', $user->id)
                  ->firstOrFail();

        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10|max:2000',
            'budget' => 'required|numeric|min:1|max:9999999',
            'deadline' => 'required|date|after:today',
            'status' => 'required|in:' . implode(',', [self::STATUS_OPEN, self::STATUS_IN_PROGRESS, self::STATUS_CLOSED]),
        ], [
            'title.required' => 'O título da vaga é obrigatório',
            'description.required' => 'A descrição da vaga é obrigatória',
            'budget.required' => 'O orçamento é obrigatório',
            'deadline.required' => 'O prazo de entrega é obrigatório',
            'status.required' => 'O status da vaga é obrigatório',
        ]);

        try {
            $job->update([
                'title' => $request->title,
                'description' => $request->description,
                'budget' => $request->budget,
                'deadline' => $request->deadline,
                'status' => $request->status,
            ]);

            return redirect()->route('vagas.manage')->with('success', '✅ Vaga atualizada com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Erro ao atualizar vaga: ' . $e->getMessage());
        }
    }

    /**
     * Retorna a cor do Bootstrap baseada no status
     */
    public function getStatusColor($status)
    {
        return match($status) {
            'pendente' => 'warning',
            'aceito' => 'success',
            'rejeitado' => 'danger',
            'aberto' => 'success',
            'em andamento' => 'primary',
            'fechado' => 'secondary',
            default => 'secondary'
        };
    }

    /**
     * Retorna o ícone baseado no status
     */
    public function getStatusIcon($status)
    {
        return match($status) {
            'pendente' => 'fas fa-clock',
            'aceito' => 'fas fa-check-circle',
            'rejeitado' => 'fas fa-times-circle',
            'aberto' => 'fas fa-door-open',
            'em andamento' => 'fas fa-spinner',
            'fechado' => 'fas fa-lock',
            default => 'fas fa-question-circle'
        };
    }
}