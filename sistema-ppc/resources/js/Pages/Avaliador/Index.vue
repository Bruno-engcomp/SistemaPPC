<template>
  <MainLayout>
    <h2>Fila de Propostas Pendentes de Avaliação</h2>
    <p class="subtitle">Propostas submetidas pelas unidades acadêmicas aguardando parecer técnico.</p>

    <div class="card-grid">
      <div v-for="item in propostas" :key="item.id" class="card">
        <div class="card-top">
          <span class="unidade-badge">{{ item.unidade?.sigla || 'UNIDADE' }}</span>
          <StatusBadge :status="item.status" />
        </div>
        <h3>{{ item.nome_curso }}</h3>
        <p class="desc">{{ item.justificativa?.substring(0, 120) }}...</p>

        <div class="card-actions">
          <Link :href="`/avaliador/propostas/${item.id}/avaliar`" class="btn-avaliar">
            Emitir Parecer Técnico
          </Link>
        </div>
      </div>

      <div v-if="!propostas || propostas.length === 0" class="empty-state">
        Nenhuma proposta pendente na fila de avaliação.
      </div>
    </div>
  </MainLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import MainLayout from '../../Layouts/MainLayout.vue';
import StatusBadge from '../../Components/StatusBadge.vue';

defineProps({
  propostas: Array
});
</script>

<style scoped>
.subtitle {
  color: #6b7280;
  font-size: 0.9rem;
  margin-bottom: 1.5rem;
  margin-top: 0.2rem;
}
.card-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
}
.card {
  background: #ffffff;
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  box-shadow: 0 1px 4px rgba(0,0,0,0.06);
  transition: box-shadow 0.2s ease;
}
.card:hover {
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.card-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.8rem;
}
.unidade-badge {
  background: #dbeafe;
  color: #1e40af;
  padding: 0.2rem 0.6rem;
  border-radius: 4px;
  font-size: 0.78rem;
  font-weight: 700;
}
h3 {
  color: #1f2937;
  margin-bottom: 0.5rem;
}
.desc {
  color: #6b7280;
  font-size: 0.88rem;
  margin-bottom: 1.5rem;
  flex: 1;
}
.btn-avaliar {
  display: block;
  text-align: center;
  background: #1e40af;
  color: #fff;
  padding: 0.6rem;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9rem;
  transition: background-color 0.2s ease, transform 0.15s ease;
}
.btn-avaliar:hover {
  background: #1d3a95;
  transform: translateY(-2px);
}
.empty-state {
  grid-column: 1 / -1;
  text-align: center;
  color: #9ca3af;
  padding: 3rem;
  background: #ffffff;
  border-radius: 10px;
  border: 1px solid #e5e7eb;
}
</style>
