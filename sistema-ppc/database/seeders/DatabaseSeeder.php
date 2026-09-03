<?php

namespace Database\Seeders;

use App\Enums\StatusProposta;
use App\Models\Disciplina;
use App\Models\Proposta;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Unidades Acadêmicas / Faculdades da UFPA
        $fct = Unidade::create([
            'nome' => 'Faculdade de Computação e Telecomunicações',
            'sigla' => 'FCT',
            'email_contato' => 'fct@ufpa.com.br',
        ]);

        $itec = Unidade::create([
            'nome' => 'Instituto de Tecnologia',
            'sigla' => 'ITEC',
            'email_contato' => 'itec@ufpa.com.br',
        ]);

        // Usuários de Teste para Entrevista (Domínio UFPA)
        User::create([
            'name' => 'Prof. Coordenador FCT (Unidade)',
            'email' => 'fct@ufpa.com.br',
            'password' => Hash::make('senha123'),
            'perfil' => 'UNIDADE',
            'unidade_id' => $fct->id,
        ]);

        User::create([
            'name' => 'Dra. Maria (Avaliador Técnico)',
            'email' => 'avaliador@ufpa.br',
            'password' => Hash::make('senha123'),
            'perfil' => 'AVALIADOR',
        ]);

        User::create([
            'name' => 'Membro da Câmara de Ensino',
            'email' => 'camara@ufpa.br',
            'password' => Hash::make('senha123'),
            'perfil' => 'CAMARA',
        ]);

        // Proposta 1: Engenharia da Computação (FCT)
        $p1 = Proposta::create([
            'unidade_id' => $fct->id,
            'nome_curso' => 'Engenharia da Computação',
            'modalidade' => 'Presencial',
            'carga_horaria_total' => 3600,
            'justificativa' => 'Atualização do PPC para inclusão de matérias de Sistemas Embarcados, Inteligência Artificial e Arquitetura de Computadores.',
            'perfil_egresso' => 'Engenheiros de Computação capacitados para desenvolvimento de hardware, software embarcado e sistemas distribuídos.',
            'status' => StatusProposta::SUBMETIDO,
        ]);

        Disciplina::create([
            'proposta_id' => $p1->id,
            'nome' => 'Introdução à Engenharia da Computação',
            'codigo' => 'EC0001',
            'carga_horaria' => 60,
            'periodo' => 1,
            'ementa' => 'Conceitos básicos de hardware, lógica de programação e histórico da computação.',
        ]);

        Disciplina::create([
            'proposta_id' => $p1->id,
            'nome' => 'Circuitos Lógicos e Eletrônica Digital',
            'codigo' => 'EC0002',
            'carga_horaria' => 90,
            'periodo' => 2,
            'ementa' => 'Álgebra de Boole, portas lógicas, circuitos combinacionais e sequenciais.',
        ]);

        Disciplina::create([
            'proposta_id' => $p1->id,
            'nome' => 'Sistemas Embarcados e Arquitetura',
            'codigo' => 'EC0003',
            'carga_horaria' => 90,
            'periodo' => 5,
            'ementa' => 'Microcontroladores, interrupções, barramentos e tempo real.',
        ]);

        // Proposta 2: Engenharia Elétrica (ITEC)
        $p2 = Proposta::create([
            'unidade_id' => $itec->id,
            'nome_curso' => 'Engenharia Elétrica',
            'modalidade' => 'Presencial',
            'carga_horaria_total' => 3800,
            'justificativa' => 'Reformulação curricular com foco em Sistemas de Potência, Energias Renováveis e Automação Industrial.',
            'perfil_egresso' => 'Engenheiros Eletricistas aptos a projetar sistemas de geração, transmissão e distribuição de energia.',
            'status' => StatusProposta::APROVADO_CAMARA,
        ]);

        Disciplina::create([
            'proposta_id' => $p2->id,
            'nome' => 'Circuitos Elétricos I',
            'codigo' => 'EE0001',
            'carga_horaria' => 90,
            'periodo' => 3,
            'ementa' => 'Leis de Kirchhoff, análise nodal e de malhas, regimes permanente e transitório.',
        ]);

        Disciplina::create([
            'proposta_id' => $p2->id,
            'nome' => 'Sistemas de Energia e Potência',
            'codigo' => 'EE0002',
            'carga_horaria' => 90,
            'periodo' => 6,
            'ementa' => 'Geração, fluxo de carga, transformadores e estabilidade de rede.',
        ]);
    }
}
