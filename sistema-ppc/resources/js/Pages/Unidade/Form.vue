<template>
  <MainLayout>
    <div class="form-header">
      <h2>{{ proposta ? 'Editar Proposta de PPC' : 'Cadastrar Nova Proposta de PPC' }}</h2>
      <Link href="/unidade/propostas" class="btn-back">← Voltar</Link>
    </div>

    <form @submit.prevent="submit" class="form-container">
      <div class="form-section">
        <h3>1. Informações Gerais do Curso</h3>
        <div class="grid-2">
          <div class="form-group">
            <label>Unidade Acadêmica</label>
            <select v-model="form.unidade_id" required>
              <option value="" disabled>Selecione a Unidade</option>
              <option v-for="u in unidades" :key="u.id" :value="u.id">{{ u.nome }} ({{ u.sigla }})</option>
            </select>
          </div>
          <div class="form-group">
            <label>Nome do Curso</label>
            <input type="text" v-model="form.nome_curso" placeholder="Ex: Bacharelado em Ciência da Computação" required />
          </div>
          <div class="form-group">
            <label>Modalidade</label>
            <select v-model="form.modalidade" required>
              <option value="Presencial">Presencial</option>
              <option value="EAD">EAD</option>
              <option value="Híbrido">Híbrido</option>
            </select>
          </div>
          <div class="form-group">
            <label>Carga Horária Total (Horas)</label>
            <input type="number" v-model.number="form.carga_horaria_total" min="100" required />
          </div>
        </div>

        <div class="form-group full">
          <label>Justificativa da Criação/Reformulação</label>
          <textarea v-model="form.justificativa" rows="3" required></textarea>
        </div>

        <div class="form-group full">
          <label>Perfil do Egresso</label>
          <textarea v-model="form.perfil_egresso" rows="3" required></textarea>
        </div>
      </div>

      <div class="form-section">
        <h3>2. Estrutura Curricular (Disciplinas)</h3>
        <DisciplinaForm v-model="form.disciplinas" />
      </div>

      <div class="form-footer">
        <button type="submit" class="btn-submit" :disabled="form.processing">
          {{ form.processing ? 'Enviando...' : 'Submeter Proposta para Avaliação' }}
        </button>
      </div>
    </form>
  </MainLayout>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import MainLayout from '../../Layouts/MainLayout.vue';
import DisciplinaForm from '../../Components/DisciplinaForm.vue';

const props = defineProps({
  proposta: Object,
  unidades: Array
});

const form = useForm({
  unidade_id: props.proposta?.unidade_id || '',
  nome_curso: props.proposta?.nome_curso || '',
  modalidade: props.proposta?.modalidade || 'Presencial',
  carga_horaria_total: props.proposta?.carga_horaria_total || 3000,
  justificativa: props.proposta?.justificativa || '',
  perfil_egresso: props.proposta?.perfil_egresso || '',
  disciplinas: props.proposta?.disciplinas || []
});

const submit = () => {
  if (props.proposta) {
    form.put(`/unidade/propostas/${props.proposta.id}`);
  } else {
    form.post('/unidade/propostas');
  }
};
</script>

<style scoped>
.form-header {
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
.form-container {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}
.form-section {
  background: #ffffff;
  border-radius: 10px;
  padding: 1.5rem;
  border: 1px solid #e5e7eb;
  box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}
.form-section h3 {
  margin-bottom: 1rem;
  color: #1e40af;
  font-size: 1rem;
  border-bottom: 1px solid #e5e7eb;
  padding-bottom: 0.5rem;
}
.grid-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.3rem;
  margin-bottom: 1rem;
}
.form-group.full {
  grid-column: 1 / -1;
}
label {
  font-size: 0.88rem;
  color: #4b5563;
  font-weight: 500;
}
input, select, textarea {
  background: #f9fafb;
  border: 1px solid #d1d5db;
  color: #1f2937;
  padding: 0.6rem;
  border-radius: 6px;
  font-size: 0.9rem;
}
input:focus, select:focus, textarea:focus {
  outline: none;
  border-color: #6b7280;
}
.form-footer {
  text-align: right;
}
.btn-submit {
  background: #1e40af;
  color: #fff;
  padding: 0.8rem 1.5rem;
  border: none;
  border-radius: 8px;
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
