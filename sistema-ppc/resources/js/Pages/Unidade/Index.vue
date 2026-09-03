<template>
  <MainLayout>
    <div class="header-action">
      <div>
        <h2>Propostas de PPC - Unidade Acadêmica</h2>
        <p class="subtitle">Gerencie e acompanhe as propostas pedagógicas da sua unidade.</p>
      </div>
      <Link href="/unidade/propostas/nova" class="btn-primary">+ Nova Proposta</Link>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Curso</th>
            <th>Modalidade</th>
            <th>Carga Horária</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in propostas" :key="item.id">
            <td><strong>{{ item.nome_curso }}</strong></td>
            <td>{{ item.modalidade }}</td>
            <td>{{ item.carga_horaria_total }}h</td>
            <td><StatusBadge :status="item.status" /></td>
            <td>
              <Link :href="`/unidade/propostas/${item.id}/editar`" class="btn-sm">Editar</Link>
            </td>
          </tr>
          <tr v-if="!propostas || propostas.length === 0">
            <td colspan="5" class="empty">Nenhuma proposta cadastrada ainda.</td>
          </tr>
        </tbody>
      </table>
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
.header-action {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
}
.subtitle {
  color: #6b7280;
  font-size: 0.9rem;
  margin-top: 0.2rem;
}
.btn-primary {
  background: #1e40af;
  color: #ffffff;
  padding: 0.6rem 1.2rem;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.9rem;
  transition: background-color 0.2s ease, transform 0.15s ease;
}
.btn-primary:hover {
  background: #1d3a95;
  transform: translateY(-2px);
}
.table-container {
  background: #ffffff;
  border-radius: 10px;
  overflow: hidden;
  border: 1px solid #e5e7eb;
  box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}
table {
  width: 100%;
  border-collapse: collapse;
  text-align: left;
}
th, td {
  padding: 1rem;
  border-bottom: 1px solid #e5e7eb;
}
th {
  background: #f3f4f6;
  color: #374151;
  font-size: 0.85rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}
td {
  color: #1f2937;
  font-size: 0.9rem;
}
tbody tr:hover {
  background: #f9fafb;
}
.btn-sm {
  background: #e5e7eb;
  color: #1f2937;
  padding: 0.3rem 0.7rem;
  border-radius: 4px;
  text-decoration: none;
  font-size: 0.85rem;
  font-weight: 600;
  transition: background-color 0.2s ease;
}
.btn-sm:hover {
  background: #d1d5db;
}
.empty {
  text-align: center;
  color: #9ca3af;
  padding: 2.5rem;
}
</style>
