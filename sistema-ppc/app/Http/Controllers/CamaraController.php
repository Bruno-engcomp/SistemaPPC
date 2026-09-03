<?php

namespace App\Http\Controllers;

use App\Enums\StatusProposta;
use App\Models\Proposta;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CamaraController extends Controller
{
    public function index(): Response
    {
        $propostas = Proposta::with('unidade', 'avaliacoes')
            ->where('status', StatusProposta::APROVADO_CAMARA)
            ->latest()
            ->get();

        return Inertia::render('Camara/Index', [
            'propostas' => $propostas,
        ]);
    }

    public function decisao(Proposta $proposta): Response
    {
        $proposta->load(['unidade', 'disciplinas', 'avaliacoes']);

        return Inertia::render('Camara/Decisao', [
            'proposta' => $proposta,
        ]);
    }

    public function homologar(Request $request, Proposta $proposta)
    {
        $validated = $request->validate([
            'decisao' => 'required|in:APROVADO,REPROVADO,RETORNADO',
            'justificativa_camara' => 'required|string',
        ]);

        $statusFinal = match($validated['decisao']) {
            'APROVADO' => StatusProposta::APROVADO,
            'REPROVADO' => StatusProposta::REPROVADO,
            'RETORNADO' => StatusProposta::RETORNADO,
        };

        $proposta->update([
            'status' => $statusFinal,
        ]);

        return redirect()->route('camara.index')
            ->with('success', 'Decisão da Câmara registrada com sucesso!');
    }
}
