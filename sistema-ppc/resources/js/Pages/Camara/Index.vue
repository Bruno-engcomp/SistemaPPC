<template>
  <MainLayout>
    <h2>Câmara de Ensino - Deliberação de Propostas</h2>
    <p class="subtitle">Propostas de PPC aprovadas na etapa técnica aguardando decisão final da Câmara.</p>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Curso</th>
            <th>Unidade Acadêmica</th>
            <th>Parecer Técnico</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in propostas" :key="item.id">
            <td><strong>{{ item.nome_curso }}</strong></td>
            <td>{{ item.unidade?.nome }} ({{ item.unidade?.sigla }})</td>
            <td>
              <span class="parecer-tag">Aprovado pelo Avaliador</span>
            </td>
            <td>
              <Link :href="`/camara/propostas/${item.id}/decisao`" class="btn-decisao">Registrar Decisão</Link>
            </td>
          </tr>
          <tr v-if="!propostas || propostas.length === 0">
            <td colspan="4" class="empty">Nenhuma proposta aguardando deliberação da Câmara de Ensino.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </MainLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import MainLayout from '../../Layouts/MainLayout.vue';

defineProps({
  propostas: Array
});
</script>

<style scoped>
.subtitle {
  color: #6b7280;
  margin-bottom: 1.5rem;
  margin-top: 0.2rem;
  font-size: 0.9rem;
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
tbody tr:hover { background: #f9fafb; }
.parecer-tag {
  background: #dcfce7;
  color: #166534;
  padding: 0.2rem 0.6rem;
  border-radius: 12px;
  font-size: 0.78rem;
  font-weight: 600;
}
.btn-decisao {
  background: #7c3aed;
  color: #fff;
  padding: 0.4rem 0.8rem;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.85rem;
  transition: background-color 0.2s ease, transform 0.15s ease;
}
.btn-decisao:hover {
  background: #6d28d9;
  transform: translateY(-2px);
}
.empty {
  text-align: center;
  color: #9ca3af;
  padding: 3rem;
}
</style>
