<?php

namespace App\Http\Controllers;

use App\Enums\StatusProposta;
use App\Models\Avaliacao;
use App\Models\Proposta;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AvaliacaoController extends Controller
{
    public function index(): Response
    {
        $propostasPendentes = Proposta::with('unidade')
            ->whereIn('status', [StatusProposta::SUBMETIDO, StatusProposta::EM_AVALIACAO])
            ->latest()
            ->get();

        return Inertia::render('Avaliador/Index', [
            'propostas' => $propostasPendentes,
        ]);
    }

    public function avaliar(Proposta $proposta): Response
    {
        $proposta->load(['unidade', 'disciplinas', 'avaliacoes']);

        return Inertia::render('Avaliador/Avaliar', [
            'proposta' => $proposta,
        ]);
    }

    public function salvarParecer(Request $request, Proposta $proposta)
    {
        $validated = $request->validate([
            'parecer' => 'required|string',
            'status_parecer' => 'required|in:APROVADO,COM_RESSALVAS,REPROVADO',
            'observacoes' => 'nullable|string',
        ]);

        Avaliacao::create([
            'proposta_id' => $proposta->id,
            'avaliador_id' => auth()->id() ?? 1,
            'parecer' => $validated['parecer'],
            'status_parecer' => $validated['status_parecer'],
            'observacoes' => $validated['observacoes'] ?? null,
        ]);

        $novoStatus = match($validated['status_parecer']) {
            'APROVADO' => StatusProposta::APROVADO_CAMARA,
            'COM_RESSALVAS' => StatusProposta::RETORNADO,
            'REPROVADO' => StatusProposta::REPROVADO,
        };

        $proposta->update(['status' => $novoStatus]);

        return redirect()->route('avaliador.index')
            ->with('success', 'Parecer emitido com sucesso!');
    }
}
