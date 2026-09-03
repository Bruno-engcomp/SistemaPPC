<?php

namespace App\Http\Controllers;

use App\Enums\StatusProposta;
use App\Http\Requests\PropostaStoreRequest;
use App\Models\Proposta;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PropostaController extends Controller
{
    public function index(): Response
    {
        $propostas = Proposta::with('unidade', 'disciplinas')
            ->latest()
            ->get();

        return Inertia::render('Unidade/Index', [
            'propostas' => $propostas,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Unidade/Form', [
            'unidades' => Unidade::all(),
        ]);
    }

    public function store(PropostaStoreRequest $request)
    {
        $validated = $request->validated();
        
        $proposta = Proposta::create([
            'unidade_id' => $validated['unidade_id'],
            'nome_curso' => $validated['nome_curso'],
            'modalidade' => $validated['modalidade'],
            'carga_horaria_total' => $validated['carga_horaria_total'],
            'justificativa' => $validated['justificativa'],
            'perfil_egresso' => $validated['perfil_egresso'],
            'status' => StatusProposta::SUBMETIDO,
        ]);

        foreach ($validated['disciplinas'] as $disc) {
            $proposta->disciplinas()->create($disc);
        }

        return redirect()->route('unidade.propostas.index')
            ->with('success', 'Proposta submetida com sucesso!');
    }

    public function edit(Proposta $proposta): Response
    {
        $proposta->load('disciplinas');

        return Inertia::render('Unidade/Form', [
            'proposta' => $proposta,
            'unidades' => Unidade::all(),
        ]);
    }

    public function update(PropostaStoreRequest $request, Proposta $proposta)
    {
        $validated = $request->validated();

        $proposta->update([
            'nome_curso' => $validated['nome_curso'],
            'modalidade' => $validated['modalidade'],
            'carga_horaria_total' => $validated['carga_horaria_total'],
            'justificativa' => $validated['justificativa'],
            'perfil_egresso' => $validated['perfil_egresso'],
            'status' => StatusProposta::SUBMETIDO,
        ]);

        $proposta->disciplinas()->delete();
        foreach ($validated['disciplinas'] as $disc) {
            $proposta->disciplinas()->create($disc);
        }

        return redirect()->route('unidade.propostas.index')
            ->with('success', 'Proposta atualizada e ressubmetida!');
    }
}
