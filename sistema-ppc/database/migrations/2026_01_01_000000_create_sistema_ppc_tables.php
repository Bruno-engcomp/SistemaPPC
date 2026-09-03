<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('sigla', 20);
            $table->string('email_contato');
            $table->timestamps();
        });

        Schema::create('propostas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unidade_id')->constrained('unidades')->cascadeOnDelete();
            $table->string('nome_curso');
            $table->string('modalidade');
            $table->integer('carga_horaria_total');
            $table->text('justificativa');
            $table->text('perfil_egresso');
            $table->string('status')->default('SUBMETIDO');
            $table->timestamps();
        });

        Schema::create('disciplinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposta_id')->constrained('propostas')->cascadeOnDelete();
            $table->string('nome');
            $table->string('codigo')->nullable();
            $table->integer('carga_horaria');
            $table->integer('periodo');
            $table->text('ementa')->nullable();
            $table->timestamps();
        });

        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposta_id')->constrained('propostas')->cascadeOnDelete();
            $table->unsignedBigInteger('avaliador_id')->default(1);
            $table->text('parecer');
            $table->enum('status_parecer', ['APROVADO', 'COM_RESSALVAS', 'REPROVADO']);
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
        Schema::dropIfExists('disciplinas');
        Schema::dropIfExists('propostas');
        Schema::dropIfExists('unidades');
    }
};
