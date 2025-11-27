<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'assunto' => 'required|string',
            'mensagem' => 'required|string|max:2000',
        ]);

        // Simulação de envio de e-mail
        Mail::raw("
            Nome: {$request->nome}
            E-mail: {$request->email}
            Assunto: {$request->assunto}
            Mensagem: {$request->mensagem}
        ", function ($msg) use ($request) {
            $msg->to('suporte@slofy.dev')
                ->subject('Nova mensagem de contato - Slofy.Dev');
        });

        return back()->with('success', 'Sua mensagem foi enviada com sucesso! Entraremos em contato em breve.');
    }
}
