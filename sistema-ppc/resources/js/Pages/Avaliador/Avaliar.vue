<template>
  <MainLayout>
    <div class="header">
      <h2>Avaliação Técnica de PPC</h2>
      <Link href="/avaliador/propostas" class="btn-back">← Voltar à fila</Link>
    </div>

    <div class="split-view">
      <div class="proposta-details">
        <h3>{{ proposta?.nome_curso }}</h3>
        <p><strong>Unidade:</strong> {{ proposta?.unidade?.nome }}</p>
        <p><strong>Modalidade:</strong> {{ proposta?.modalidade }} | <strong>Carga Horária:</strong> {{ proposta?.carga_horaria_total }}h</p>

        <h4>Justificativa</h4>
        <p class="text-box">{{ proposta?.justificativa }}</p>

        <h4>Perfil do Egresso</h4>
        <p class="text-box">{{ proposta?.perfil_egresso }}</p>

        <h4>Disciplinas Cadastradas</h4>
        <ul class="disc-list">
          <li v-for="d in proposta?.disciplinas" :key="d.id">
            <strong>{{ d.codigo ? d.codigo + ' - ' : '' }}{{ d.nome }}</strong> ({{ d.carga_horaria }}h) - {{ d.periodo }}º Semestre
          </li>
        </ul>
      </div>

      <div class="parecer-form">
        <h3>Formulário de Parecer Técnico</h3>
        <form @submit.prevent="submit">
          <div class="form-group">
            <label>Resultado do Parecer</label>
            <select v-model="form.status_parecer" required>
              <option value="APROVADO">Aprovado sem ressalvas</option>
              <option value="COM_RESSALVAS">Retornar para Ajustes (Com ressalvas)</option>
              <option value="REPROVADO">Reprovado</option>
            </select>
          </div>

          <div class="form-group">
            <label>Parecer Técnico Detalhado</label>
            <textarea v-model="form.parecer" rows="6" placeholder="Descreva os pontos fortes, fragilidades ou adequações necessárias..." required></textarea>
          </div>

          <div class="form-group">
            <label>Observações Internas (Opcional)</label>
            <textarea v-model="form.observacoes" rows="2"></textarea>
          </div>

          <button type="submit" class="btn-submit" :disabled="form.processing">
            {{ form.processing ? 'Enviando Parecer...' : 'Enviar Parecer' }}
          </button>
        </form>
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import MainLayout from '../../Layouts/MainLayout.vue';

const props = defineProps({
  proposta: Object
});

const form = useForm({
  status_parecer: 'APROVADO',
  parecer: '',
  observacoes: ''
});

const submit = () => {
  form.post(`/avaliador/propostas/${props.proposta.id}/parecer`);
};
</script>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}
.btn-back {
  color: #6b7280;
  text-decoration: none;
  font-size: 0.9rem;
}
.btn-back:hover { color: #374151; }
.split-view {
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 1.5rem;
}
.proposta-details, .parecer-form {
  background: #ffffff;
  border-radius: 10px;
  padding: 1.5rem;
  border: 1px solid #e5e7eb;
  box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}
.text-box {
  background: #f9fafb;
  border: 1px solid #e5e7eb;
  padding: 0.8rem;
  border-radius: 6px;
  color: #374151;
  font-size: 0.9rem;
  margin-bottom: 1rem;
}
.disc-list {
  list-style: none;
  padding: 0;
}
.disc-list li {
  padding: 0.5rem 0;
  border-bottom: 1px solid #e5e7eb;
  font-size: 0.9rem;
  color: #374151;
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.3rem;
  margin-bottom: 1rem;
}
label {
  font-size: 0.88rem;
  color: #4b5563;
  font-weight: 500;
}
select, textarea {
  background: #f9fafb;
  border: 1px solid #d1d5db;
  color: #1f2937;
  padding: 0.6rem;
  border-radius: 6px;
  font-size: 0.9rem;
}
select:focus, textarea:focus {
  outline: none;
  border-color: #6b7280;
}
.btn-submit {
  width: 100%;
  background: #1e40af;
  color: #fff;
  padding: 0.8rem;
  border: none;
  border-radius: 6px;
  font-weight: 700;
  cursor: pointer;
  transition: background-color 0.2s ease, transform 0.15s ease;
}
.btn-submit:hover:not(:disabled) {
  background: #1d3a95;
  transform: translateY(-2px);
}
.btn-submit:disabled { opacity: 0.6; cursor: not-allowed; }
</style>
