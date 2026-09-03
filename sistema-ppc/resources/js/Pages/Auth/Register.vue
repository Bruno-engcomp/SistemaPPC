<template>
  <div class="auth-wrapper">
    <div class="auth-card">
      <div class="brand-header">
        <img src="/ufpa_logo.png" alt="UFPA Logo" class="logo-circle"/>
        <h2>Novo Cadastro</h2>
        <p class="subtitle">Crie sua conta no Sistema PPC</p>
      </div>

      <form @submit.prevent="submit" class="auth-form">
        <div class="form-group">
          <label for="name">Nome Completo</label>
          <input
            id="name"
            type="text"
            v-model="form.name"
            placeholder="Seu Nome Completo"
            required
            :class="{ 'input-error': form.errors.name }"
          />
          <span v-if="form.errors.name" class="error-msg">{{ form.errors.name }}</span>
        </div>

        <div class="form-group">
          <label for="email">E-mail</label>
          <input
            id="email"
            type="email"
            v-model="form.email"
            placeholder="seu.email@universidade.edu.br"
            required
            :class="{ 'input-error': form.errors.email }"
          />
          <span v-if="form.errors.email" class="error-msg">{{ form.errors.email }}</span>
        </div>

        <div class="form-group">
          <label for="perfil">Perfil de Acesso</label>
          <select id="perfil" v-model="form.perfil" required :class="{ 'input-error': form.errors.perfil }">
            <option value="UNIDADE">📍 Unidade Acadêmica (Elaborador de PPC)</option>
            <option value="AVALIADOR">📝 Avaliador Técnico (Parecerista)</option>
            <option value="CAMARA">⚖️ Câmara de Ensino (Homologador)</option>
          </select>
          <span v-if="form.errors.perfil" class="error-msg">{{ form.errors.perfil }}</span>
        </div>

        <div v-if="form.perfil === 'UNIDADE'" class="form-group">
          <label for="unidade_id">Unidade Acadêmica</label>
          <select id="unidade_id" v-model="form.unidade_id" required :class="{ 'input-error': form.errors.unidade_id }">
            <option value="" disabled>Selecione a sua Unidade</option>
            <option v-for="u in unidades" :key="u.id" :value="u.id">
              {{ u.nome }} ({{ u.sigla }})
            </option>
          </select>
          <span v-if="form.errors.unidade_id" class="error-msg">{{ form.errors.unidade_id }}</span>
        </div>

        <div class="grid-2">
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
          </div>

          <div class="form-group">
            <label for="password_confirmation">Confirmar Senha</label>
            <input
              id="password_confirmation"
              type="password"
              v-model="form.password_confirmation"
              placeholder="••••••••"
              required
            />
          </div>
        </div>
        <span v-if="form.errors.password" class="error-msg">{{ form.errors.password }}</span>

        <button type="submit" class="btn-submit" :disabled="form.processing">
          {{ form.processing ? 'Cadastrando...' : 'Criar Conta' }}
        </button>
      </form>

      <div class="auth-footer">
        Já possui uma conta? <Link href="/login">Voltar ao Login</Link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3';

defineProps({
  unidades: Array
});

const form = useForm({
  name: '',
  email: '',
  perfil: 'UNIDADE',
  unidade_id: '',
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post('/register');
};
</script>

<style scoped>
.auth-wrapper {
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: radial-gradient(circle at top right, #1e293b 0%, #0b1329 100%);
  padding: 1.5rem;
  font-family: system-ui, -apple-system, sans-serif;
}

.auth-card {
  width: 100%;
  max-width: 480px;
  background: rgba(30, 41, 59, 0.75);
  backdrop-filter: blur(16px);
  border: 1px solid #334155;
  border-radius: 16px;
  padding: 2.5rem;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

.brand-header {
  text-align: center;
  margin-bottom: 1.5rem;
}

.logo-circle {
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
}

h2 {
  color: #f8fafc;
  font-size: 1.75rem;
  font-weight: 700;
  margin: 0;
}

.subtitle {
  color: #94a3b8;
  font-size: 0.9rem;
  margin-top: 0.3rem;
}

.auth-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.grid-2 {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0.8rem;
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
}

label {
  color: #cbd5e1;
  font-size: 0.85rem;
  font-weight: 600;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
  background: #0f172a;
  border: 1px solid #334155;
  border-radius: 8px;
  color: #f8fafc;
  padding: 0.75rem 1rem;
  font-size: 0.95rem;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

input:focus, select:focus {
  outline: none;
  border-color: #38bdf8;
  box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
}

.input-error {
  border-color: #ef4444 !important;
}

.error-msg {
  color: #f87171;
  font-size: 0.8rem;
}

.btn-submit {
  background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%);
  color: #0f172a;
  font-weight: 700;
  font-size: 1rem;
  padding: 0.85rem;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: transform 0.15s ease, opacity 0.2s ease;
  margin-top: 0.5rem;
}

.btn-submit:hover:not(:disabled) {
  opacity: 0.95;
  transform: translateY(-1px);
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
