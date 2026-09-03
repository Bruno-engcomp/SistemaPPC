<template>
  <div class="layout-container">
    <div class="logo-corner left">
      <img src="/images/ufpa_logo.png" alt="UFPA Logo" class="ufpa-logo" />
    </div>
    <div class="logo-corner right">
      <img src="/images/ufpa_logo.png" alt="UFPA Logo" class="ufpa-logo" />
    </div>
    <Navbar />
    <main class="main-content">
      <transition name="page-fade" mode="out-in">
        <div :key="$page.url">
          <slot />
        </div>
      </transition>
    </main>
    <footer class="footer">
      <p>Sistema PPC &copy; 2026 - Gestão de Projetos Pedagógicos de Curso</p>
    </footer>
  </div>
</template>

<script setup>
import Navbar from '../Components/Navbar.vue';
</script>

<style>
* { margin: 0; padding: 0; box-sizing: border-box; }
body {
  background-color: #f5f6f8;
  color: #2d2d2d;
  font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
  overflow-x: hidden;
}
h2 { color: #1a1a2e; font-weight: 700; margin-bottom: 0.3rem; }
h3 { color: #1a1a2e; margin-bottom: 0.5rem; }
h4 { color: #374151; margin-bottom: 0.4rem; }
.layout-container {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  position: relative;
}
.main-content {
  flex: 1;
  max-width: 1200px;
  width: 100%;
  margin: 2rem auto;
  padding: 0 1.5rem;
}
.footer {
  text-align: center;
  padding: 1.2rem;
  background: #e8eaed;
  border-top: 1px solid #d1d5db;
  color: #6b7280;
  font-size: 0.85rem;
}

/* Logo corners */
.logo-corner {
  position: fixed;
  top: 0.6rem;
  width: 64px;
  height: auto;
  z-index: 100;
}
.logo-corner.left { left: 0.8rem; }
.logo-corner.right { right: 0.8rem; }
.ufpa-logo { max-width: 100%; height: auto; }

/* Page transitions */
.page-fade-enter-active,
.page-fade-leave-active {
  transition: opacity 0.25s ease, transform 0.25s ease;
}
.page-fade-enter-from {
  opacity: 0;
  transform: translateY(8px);
}
.page-fade-leave-to {
  opacity: 0;
  transform: translateY(-8px);
}
</style>
