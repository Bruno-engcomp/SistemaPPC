<template>
  <span class="badge" :class="badgeClass">
    {{ labelText }}
  </span>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  status: {
    type: String,
    required: true
  }
});

const badgeMap = {
  RASCUNHO:       { label: 'Rascunho',            class: 'gray' },
  SUBMETIDO:      { label: 'Submetido',            class: 'blue' },
  EM_AVALIACAO:   { label: 'Em Avaliação',         class: 'yellow' },
  RETORNADO:      { label: 'Retornado p/ Ajustes', class: 'orange' },
  APROVADO_CAMARA:{ label: 'Aguardando Câmara',    class: 'purple' },
  APROVADO:       { label: 'Aprovado Final',        class: 'green' },
  REPROVADO:      { label: 'Reprovado',             class: 'red' },
};

const labelText = computed(() => badgeMap[props.status]?.label || props.status);
const badgeClass = computed(() => badgeMap[props.status]?.class || 'gray');
</script>

<style scoped>
.badge {
  display: inline-block;
  padding: 0.25rem 0.6rem;
  border-radius: 12px;
  font-size: 0.78rem;
  font-weight: 600;
}
/* Light institutional badge palette */
.gray   { background: #e5e7eb; color: #374151; }
.blue   { background: #dbeafe; color: #1e40af; }
.yellow { background: #fef9c3; color: #92400e; }
.orange { background: #ffedd5; color: #9a3412; }
.purple { background: #f3e8ff; color: #6b21a8; }
.green  { background: #dcfce7; color: #166534; }
.red    { background: #fee2e2; color: #991b1b; }
</style>
