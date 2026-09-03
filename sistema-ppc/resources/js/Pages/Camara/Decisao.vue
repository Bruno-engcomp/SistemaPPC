<template>
  <MainLayout>
    <div class="header">
      <h2>Homologação e Decisão da Câmara de Ensino</h2>
      <Link href="/camara/propostas" class="btn-back">← Voltar</Link>
    </div>

    <div class="decisao-container">
      <div class="summary-card">
        <h3>{{ proposta?.nome_curso }}</h3>
        <p><strong>Unidade Proponente:</strong> {{ proposta?.unidade?.nome }}</p>
        <p><strong>Carga Horária Total:</strong> {{ proposta?.carga_horaria_total }}h</p>

        <h4>Último Parecer Técnico</h4>
        <div v-for="av in proposta?.avaliacoes" :key="av.id" class="parecer-box">
          <p><strong>Resultado:</strong> {{ av.status_parecer }}</p>
          <p>{{ av.parecer }}</p>
        </div>
      </div>

      <div class="decisao-form-card">
        <h3>Deliberação da Câmara</h3>
        <form @submit.prevent="submit">
          <div class="form-group">
            <label>Decisão Final</label>
            <select v-model="form.decisao" required>
              <option value="APROVADO">Aprovar e Homologar PPC</option>
              <option value="RETORNADO">Devolver para Ajustes</option>
              <option value="REPROVADO">Reprovar Proposta</option>
            </select>
          </div>

          <div class="form-group">
            <label>Justificativa / Ata da Reunião</label>
            <textarea v-model="form.justificativa_camara" rows="5" placeholder="Registre a resolução oficial ou justificativa da decisão..." required></textarea>
          </div>

          <button type="submit" class="btn-homologar" :disabled="form.processing">
            {{ form.processing ? 'Registrando...' : 'Salvar e Notificar Unidade' }}
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
  decisao: 'APROVADO',
  justificativa_camara: ''
});

const submit = () => {
  form.post(`/camara/propostas/${props.proposta.id}/homologar`);
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
.decisao-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.5rem;
}
.summary-card, .decisao-form-card {
  background: #ffffff;
  border-radius: 10px;
  padding: 1.5rem;
  border: 1px solid #e5e7eb;
  box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}
.parecer-box {
  background: #f9fafb;
  border: 1px solid #e5e7eb;
  padding: 1rem;
  border-radius: 6px;
  margin-top: 0.5rem;
  color: #374151;
  font-size: 0.9rem;
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
.btn-homologar {
  width: 100%;
  background: #7c3aed;
  color: #fff;
  padding: 0.8rem;
  border: none;
  border-radius: 6px;
  font-weight: 700;
  cursor: pointer;
  transition: background-color 0.2s ease, transform 0.15s ease;
}
.btn-homologar:hover:not(:disabled) {
  background: #6d28d9;
  transform: translateY(-2px);
}
.btn-homologar:disabled { opacity: 0.6; cursor: not-allowed; }
</style>
