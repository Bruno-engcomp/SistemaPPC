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
          <input type="text" v-model="disciplina.nome" placeholder="Ex: Programação " required />
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
  background: #1e293b;
  border: 1px solid #334155;
  border-radius: 8px;
  padding: 1rem;
  margin-bottom: 1rem;
}
.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  color: #38bdf8;
}
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
  color: #94a3b8;
}
input, textarea {
  background: #0f172a;
  border: 1px solid #334155;
  color: #f8fafc;
  padding: 0.5rem;
  border-radius: 6px;
}
.btn-remove {
  background: #7f1d1d;
  color: #fca5a5;
  border: none;
  padding: 0.3rem 0.6rem;
  border-radius: 4px;
  cursor: pointer;
}
.btn-add {
  background: #0284c7;
  color: #fff;
  border: none;
  padding: 0.6rem 1rem;
  border-radius: 6px;
  cursor: pointer;
  width: 100%;
}
</style>
