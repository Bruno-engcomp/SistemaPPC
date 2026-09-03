<template>
  <div class="disciplina-form-container">
    <div v-for="(disciplina, index) in modelValue" :key="index" class="disciplina-card">
      <div class="card-header">
        <h4>Disciplina #{{ index + 1 }}</h4>
        <button type="button" class="btn-remove" @click="removeDisciplina(index)">✕ Remover</button>
      </div>

      <div class="grid-form">
        <div class="form-group">
          <label>Nome da Disciplina</label>
          <input type="text" v-model="disciplina.nome" placeholder="Ex: Algoritmos I" required />
        </div>
        <div class="form-group">
          <label>Código (opcional)</label>
          <input type="text" v-model="disciplina.codigo" placeholder="Ex: EC0001" />
        </div>
        <div class="form-group">
          <label>Carga Horária (h)</label>
          <input type="number" v-model.number="disciplina.carga_horaria" min="10" required />
        </div>
        <div class="form-group">
          <label>Período / Semestre</label>
          <input type="number" v-model.number="disciplina.periodo" min="1" required />
        </div>
      </div>

      <div class="form-group full-width">
        <label>Ementa Sintética</label>
        <textarea v-model="disciplina.ementa" rows="2" placeholder="Descreva os tópicos principais..."></textarea>
      </div>
    </div>

    <button type="button" class="btn-add" @click="addDisciplina">+ Adicionar Nova Disciplina</button>
  </div>
</template>

<script setup>
const props = defineProps({
  modelValue: {
    type: Array,
    default: () => []
  }
});

const emit = defineEmits(['update:modelValue']);

const addDisciplina = () => {
  const newList = [...props.modelValue, {
    nome: '',
    codigo: '',
    carga_horaria: 60,
    periodo: 1,
    ementa: ''
  }];
  emit('update:modelValue', newList);
};

const removeDisciplina = (index) => {
  const newList = props.modelValue.filter((_, i) => i !== index);
  emit('update:modelValue', newList);
};
</script>

<style scoped>
.disciplina-card {
  background: #f9fafb;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  padding: 1rem;
  margin-bottom: 1rem;
}
.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  color: #1e40af;
}
.card-header h4 { color: #1e40af; font-size: 0.9rem; }
.grid-form {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
  gap: 1rem;
}
.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
  margin-bottom: 0.5rem;
}
.form-group label {
  font-size: 0.85rem;
  color: #4b5563;
  font-weight: 500;
}
input, textarea {
  background: #ffffff;
  border: 1px solid #d1d5db;
  color: #1f2937;
  padding: 0.5rem;
  border-radius: 6px;
  font-size: 0.88rem;
}
input:focus, textarea:focus {
  outline: none;
  border-color: #6b7280;
}
.full-width { grid-column: 1 / -1; }
.btn-remove {
  background: #fee2e2;
  color: #991b1b;
  border: 1px solid #fca5a5;
  padding: 0.3rem 0.6rem;
  border-radius: 4px;
  cursor: pointer;
  font-size: 0.82rem;
  font-weight: 600;
}
.btn-remove:hover { background: #fca5a5; }
.btn-add {
  background: #1e40af;
  color: #fff;
  border: none;
  padding: 0.6rem 1rem;
  border-radius: 6px;
  cursor: pointer;
  width: 100%;
  font-weight: 600;
  font-size: 0.9rem;
  transition: background-color 0.2s ease;
}
.btn-add:hover { background: #1d3a95; }
</style>
