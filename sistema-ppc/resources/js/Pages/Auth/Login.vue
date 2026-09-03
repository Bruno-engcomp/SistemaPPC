<template>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="brand-header">
        <img src="/ufpa_logo.png" alt="UFPA Logo" class="logo-circle"/>
        <h2>Sistema PPC</h2>
        <p class="subtitle">Gestão de Projetos Pedagógicos de Curso</p>
      </div>

      <form @submit.prevent="submit" class="auth-form">
        <div class="form-group">
          <label for="email">E-mail de Acesso</label>
          <input
            id="email"
            type="email"
            v-model="form.email"
            placeholder="seu.email@ufpa.com.br"
            required
            :class="{ 'input-error': form.errors.email }"
          />
          <span v-if="form.errors.email" class="error-msg">{{ form.errors.email }}</span>
        </div>

        <div class="form-group">
          <label for="password">Senha</label>
          <input
            id="password"
            type="password"
            v-model="form.password"
            placeholder="••••••••"
            required
            :class="{ 'input-error': form.errors.password }"
          />
          <span v-if="form.errors.password" class="error-msg">{{ form.errors.password }}</span>
        </div>

        <div class="form-options">
          <label class="remember-label">
            <input type="checkbox" v-model="form.remember" />
            Lembrar de mim
          </label>
        </div>

        <button type="submit" class="btn-submit" :disabled="form.processing">
          {{ form.processing ? 'Entrando...' : 'Acessar Sistema' }}
        </button>
      </form>

      <div class="auth-footer">
        Não possui uma conta? <Link href="/register">Cadastre-se aqui</Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});

const submit = () => {
  form.post('/login');
};
</script>

<style scoped>
.auth-wrapper {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #ffffff;
  padding: 1.5rem;
  font-family: system-ui, -apple-system, sans-serif;
}

.auth-card {
  width: 100%;
  max-width: 440px;
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(8px);
  border: 1px solid #e5e7eb;
  border-radius: 16px;
  padding: 2.5rem;
  box-shadow: 0 8px 20px -6px rgba(0, 0, 0, 0.1);
}

.brand-header {
  text-align: center;
  margin-bottom: 2rem;
}

.logo-circle {
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
}

h2 {
  color: #333333;
  font-size: 1.75rem;
  font-weight: 700;
  margin: 0;
}

.subtitle {
  color: #555555;
  font-size: 0.9rem;
  margin-top: 0.3rem;
}

.auth-form {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
}

label {
  color: #444444;
  font-size: 0.85rem;
  font-weight: 600;
}

input[type="email"],
input[type="password"],
input[type="text"],
select {
  background: #f9fafb;
  border: 1px solid #d1d5db;
  border-radius: 8px;
  color: #333333;
  padding: 0.75rem 1rem;
  font-size: 0.95rem;
}

input:focus, select:focus {
  outline: none;
  border-color: #555555;
  box-shadow: 0 0 0 3px rgba(85,85,85,0.2);
}

.input-error {
  border-color: #ef4444 !important;
}

.error-msg {
  color: #f87171;
  font-size: 0.8rem;
}

.form-options {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.85rem;
}

.remember-label {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  color: #94a3b8;
  cursor: pointer;
}

.btn-submit {
  background: #555555;
  color: #f9fafb;
  font-weight: 700;
  font-size: 1rem;
  padding: 0.85rem;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: opacity 0.2s ease, transform 0.15s ease;
  margin-top: 0.5rem;
}

.btn-submit:hover:not(:disabled) {
  opacity: 0.9;
  transform: translateY(-1px);
}

.demo-box {
  background: rgba(15, 23, 42, 0.6);
  border: 1px dashed #334155;
  border-radius: 8px;
  padding: 1rem;
  margin-top: 1.5rem;
  font-size: 0.8rem;
  color: #cbd5e1;
}

.demo-title {
  margin: 0 0 0.5rem 0;
  font-weight: 700;
  color: #38bdf8;
}

.demo-box ul {
  margin: 0;
  padding-left: 1.2rem;
}

.demo-box li {
  margin-bottom: 0.2rem;
}

code {
  background: #1e293b;
  padding: 0.1rem 0.3rem;
  border-radius: 4px;
  color: #38bdf8;
}

.auth-footer {
  text-align: center;
  margin-top: 1.5rem;
  font-size: 0.85rem;
  color: #94a3b8;
}

.auth-footer a {
  color: #38bdf8;
  text-decoration: none;
  font-weight: 600;
}

.auth-footer a:hover {
  text-decoration: underline;
}
</style>
