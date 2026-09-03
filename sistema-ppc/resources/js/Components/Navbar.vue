<template>
  <nav class="navbar">
    <div class="nav-container">
      <Link href="/" class="brand">
        <img src="/images/ufpa_logo.png" alt="UFPA" class="brand-logo" />
        <span class="brand-title">Sistema PPC</span>
      </Link>

      <div class="nav-links">
        <Link href="/unidade/propostas" :class="{ active: $page.url.startsWith('/unidade') }">Unidade Acadêmica</Link>
        <Link href="/avaliador/propostas" :class="{ active: $page.url.startsWith('/avaliador') }">Avaliador Técnico</Link>
        <Link href="/camara/propostas" :class="{ active: $page.url.startsWith('/camara') }">Câmara de Ensino</Link>
      </div>

      <div v-if="user" class="user-menu">
        <div class="user-info">
          <span class="user-name">{{ user.name }}</span>
          <span class="perfil-badge" :class="user.perfil?.toLowerCase()">
            {{ user.perfil }}
          </span>
        </div>
        <Link href="/logout" method="post" as="button" class="btn-logout">
          Sair
        </Link>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const user = computed(() => page.props.auth?.user);
</script>

<style scoped>
.navbar {
  background-color: #ffffff;
  border-bottom: 2px solid #d1d5db;
  padding: 0.7rem 1.5rem;
  box-shadow: 0 2px 6px rgba(0,0,0,0.07);
  position: relative;
  z-index: 50;
}
.nav-container {
  max-width: 1200px;
  margin: 0 auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
  padding: 0 5rem; /* room for corner logos */
}
.brand {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  text-decoration: none;
  color: #1a1a2e;
  font-weight: 700;
  font-size: 1.15rem;
}
.brand-logo {
  width: 36px;
  height: auto;
}
.nav-links {
  display: flex;
  gap: 0.4rem;
}
.nav-links a {
  color: #374151;
  text-decoration: none;
  font-weight: 600;
  font-size: 0.88rem;
  padding: 0.45rem 0.8rem;
  border-radius: 6px;
  transition: all 0.2s ease;
}
.nav-links a:hover {
  color: #1a1a2e;
  background: #f3f4f6;
}
.nav-links a.active {
  color: #1a1a2e;
  background: #e5e7eb;
  border-bottom: 2px solid #4b5563;
}

.user-menu {
  display: flex;
  align-items: center;
  gap: 0.8rem;
  background: #f3f4f6;
  padding: 0.4rem 0.8rem;
  border-radius: 30px;
  border: 1px solid #d1d5db;
}
.user-info {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}
.user-name {
  font-size: 0.82rem;
  font-weight: 600;
  color: #1f2937;
}
.perfil-badge {
  font-size: 0.68rem;
  font-weight: 700;
  padding: 0.1rem 0.4rem;
  border-radius: 10px;
  text-transform: uppercase;
}
.perfil-badge.unidade  { background: #dbeafe; color: #1e40af; }
.perfil-badge.avaliador { background: #fef9c3; color: #92400e; }
.perfil-badge.camara   { background: #f3e8ff; color: #6b21a8; }

.btn-logout {
  background: #fee2e2;
  color: #991b1b;
  border: 1px solid #fca5a5;
  padding: 0.35rem 0.7rem;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.2s ease;
}
.btn-logout:hover {
  background: #fca5a5;
  color: #7f1d1d;
}
</style>
