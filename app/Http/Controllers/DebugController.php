<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class DebugController extends Controller
{
    public function rotas()
    {
        // CORREÇÃO: Converter RouteCollection para array
        $rotasCollection = Route::getRoutes();
        $rotasArray = $rotasCollection->getRoutes(); // Isso retorna um array de rotas
        
        $info = [
            'usuario' => Auth::check() ? [
                'id' => Auth::id(),
                'nome' => Auth::user()->name,
                'role' => Auth::user()->role,
                'email' => Auth::user()->email
            ] : 'Não logado',
            'rotas_total' => count($rotasArray), // Agora count() funciona
            'rotas_gerenciar' => [],
            'url_atual' => url()->current(),
            'route_current' => Route::currentRouteName(),
            'route_has_vagas_manage' => Route::has('vagas.manage')
        ];

        foreach ($rotasArray as $rota) {
            $uri = $rota->uri();
            $name = $rota->getName();
            
            if (str_contains($uri, 'gerenciar') || 
                str_contains($name ?? '', 'manage')) {
                $info['rotas_gerenciar'][] = [
                    'uri' => $uri,
                    'name' => $name,
                    'action' => $rota->getActionName(),
                    'methods' => $rota->methods()
                ];
            }
        }

        return response()->json($info);
    }
    
    public function testManage()
    {
        try {
            $user = Auth::user();
            
            // Teste se o JobController existe e é acessível
            $controllerExists = class_exists('App\Http\Controllers\JobController');
            $methodExists = $controllerExists && method_exists('App\Http\Controllers\JobController', 'manage');
            
            return response()->json([
                'status' => 'success',
                'message' => 'Rota de teste acessada com sucesso!',
                'usuario' => $user ? [
                    'id' => $user->id,
                    'nome' => $user->name,
                    'role' => $user->role,
                    'is_empresa' => $user->isEmpresa()
                ] : 'Não logado',
                'url_vagas_gerenciar' => url('vagas/gerenciar'),
                'route_exists_vagas_manage' => Route::has('vagas.manage'),
                'controller_exists' => $controllerExists,
                'method_exists' => $methodExists,
                'rotas_testadas' => [
                    '/vagas/gerenciar',
                    '/teste-gerenciar', 
                    '/teste-manage-fix',
                    '/gerenciar-teste'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }
    
    /**
     * Teste direto do JobController
     */
    public function testJobController()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Usuário não logado'
                ], 401);
            }
            
            // Teste direto do método manage
            $jobController = new \App\Http\Controllers\JobController();
            $result = $jobController->manage();
            
            return response()->json([
                'status' => 'success',
                'message' => 'JobController::manage() executado com sucesso!',
                'result_type' => get_class($result),
                'usuario' => [
                    'id' => $user->id,
                    'nome' => $user->name,
                    'role' => $user->role,
                    'is_empresa' => $user->isEmpresa()
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
    
    public function testMiddleware()
    {
        try {
            $user = Auth::user();
            
            return response()->json([
                'status' => 'success',
                'usuario_logado' => $user ? [
                    'id' => $user->id,
                    'nome' => $user->name,
                    'role' => $user->role
                ] : 'Não logado',
                'auth_check' => Auth::check(),
                'middleware_teste' => [
                    'rota_fora_auth' => url('teste-fora-auth'),
                    'rota_dentro_auth' => url('teste-dentro-auth'),
                    'rota_original' => url('vagas/gerenciar')
                ],
                'session_id' => session()->getId(),
                'session_data' => session()->all()
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}