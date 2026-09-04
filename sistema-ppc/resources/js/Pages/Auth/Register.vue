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
  background-color: #f1f5f9;
  padding: 1.5rem;
  font-family: system-ui, -apple-system, sans-serif;
  box-sizing: border-box;
}

.auth-card {
  width: 100%;
  max-width: 480px;
  background: #ffffff;
  border: 1px solid #e2e8f0;
  border-radius: 16px;
  padding: 2.5rem;
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
  box-sizing: border-box;
}

.brand-header {
  text-align: center;
  margin-bottom: 1.5rem;
}

.logo-circle {
  max-height: 80px;
  width: auto;
  margin-bottom: 0.5rem;
}

h2 {
  color: #0f172a;
  font-size: 1.75rem;
  font-weight: 700;
  margin: 0;
}

.subtitle {
  color: #64748b;
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

@media (max-width: 480px) {
  .grid-2 {
    grid-template-columns: 1fr;
  }
}

.form-group {
  display: flex;
  flex-direction: column;
  gap: 0.4rem;
}

label {
  color: #334155;
  font-size: 0.85rem;
  font-weight: 600;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
  width: 100%;
  box-sizing: border-box;
  background: #f8fafc;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  color: #0f172a;
  padding: 0.75rem 1rem;
  font-size: 0.95rem;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

input:focus, select:focus {
  outline: none;
  border-color: #0284c7;
  box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
  background: #ffffff;
}

.input-error {
  border-color: #ef4444 !important;
}

.error-msg {
  color: #dc2626;
  font-size: 0.8rem;
}

.btn-submit {
  background: #0284c7;
  color: #ffffff;
  font-weight: 700;
  font-size: 1rem;
  padding: 0.85rem;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.15s ease, transform 0.15s ease;
  margin-top: 0.5rem;
}

.btn-submit:hover:not(:disabled) {
  background: #0369a1;
  transform: translateY(-1px);
}

.btn-submit:disabled {
  opacity: 0.7;
  cursor: not-allowed;
}

.auth-footer {
  text-align: center;
  margin-top: 1.5rem;
  font-size: 0.85rem;
  color: #64748b;
}

.auth-footer a {
  color: #0284c7;
  text-decoration: none;
  font-weight: 600;
}

.auth-footer a:hover {
  text-decoration: underline;
}
</style>