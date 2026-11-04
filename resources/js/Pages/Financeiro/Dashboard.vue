<script setup>
import { ref } from 'vue';
import Layout from '@/Layouts/CrudLayout.vue'
import { Head, router } from '@inertiajs/vue3';
import LineChart from './LineChart.vue';
import BarChart from './BarChart.vue';

// Recebe os dados do Controller
const props = defineProps({
  chartDataLine: { type: Object, required: true },
  chartDataBar: { type: Object, required: true },
  filters: { type: Object, default: () => ({}) }
});

// Estado reativo para os filtros locais
const form = ref({
  periodo: props.filters.periodo || '2026',
  categoria: props.filters.categoria || 'todos',
  busca: props.filters.busca || ''
});

// Função para aplicar os filtros via Inertia
const aplicarFiltros = () => {
  router.get(route('financeiro.dashboard'), form.value, {
    preserveState: true,
    preserveScroll: true,
  });
};

// Função para limpar os filtros
const limparFiltros = () => {
  form.value = { periodo: '2026', categoria: 'todos', busca: '' };
  aplicarFiltros();
};

// Configurações dos gráficos ajustadas para Tema Claro
const chartOptionsLine = ref({
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: { position: 'top', labels: { color: '#212529' } }, // Texto escuro
    title: { display: true, text: 'Comparativo de Desempenho por Produto', color: '#212529' }
  },
  scales: {
    x: { ticks: { color: '#6c757d' }, grid: { color: 'rgba(0, 0, 0, 0.05)' } },
    y: { ticks: { color: '#6c757d' }, grid: { color: 'rgba(0, 0, 0, 0.05)' } }
  }
});

const chartOptionsBar = ref({
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: { position: 'top', labels: { color: '#212529' } },
    title: { display: true, text: 'Desempenho Financeiro', color: '#212529' }
  },
  scales: {
    x: { ticks: { color: '#6c757d' }, grid: { color: 'rgba(0, 0, 0, 0.05)' } },
    y: { ticks: { color: '#6c757d' }, grid: { color: 'rgba(0, 0, 0, 0.05)' } }
  }
});
</script>

<template>
  <Layout>
    <Head title="Dashboard Financeiro"/>
    
    <template #header>
      <h1 class="h3 mb-0 text-dark">Dashboard Financeiro</h1>
    </template>

    <div class="container-fluid px-4">
    <!-- CARD DE FILTROS (TEMA CLARO) -->
    <div class="card bg-white text-dark border shadow-sm mb-4">
      <div class="card-header bg-light border-bottom d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0 fs-6 text-secondary">
          <i class="bi bi-funnel me-2"></i> Filtros de Pesquisa
        </h5>
        <span class="badge bg-primary">Ativos</span>
      </div>
      
      <div class="card-body">
        <form @submit.prevent="aplicarFiltros" class="row g-3 align-items-end">
          
          <!-- Filtro por Período -->
          <div class="col-12 col-md-3">
            <label for="periodo" class="form-label text-muted small">Período</label>
            <select id="periodo" v-model="form.periodo" class="form-select bg-light text-dark border">
              <option value="2026">Ano Atual (2026)</option>
              <option value="2025">Ano Anterior (2025)</option>
              <option value="ultimo_trimestre">Último Trimestre</option>
            </select>
          </div>

          <!-- Filtro por Categoria -->
          <div class="col-12 col-md-3">
            <label for="categoria" class="form-label text-muted small">Categoria</label>
            <select id="categoria" v-model="form.categoria" class="form-select bg-light text-dark border">
              <option value="todos">Todas as Categorias</option>
              <option value="vendas">Vendas Diretas</option>
              <option value="servicos">Serviços</option>
              <option value="assinaturas">Assinaturas</option>
            </select>
          </div>

          <!-- Pesquisa por texto -->
          <div class="col-12 col-md-4">
            <label for="busca" class="form-label text-muted small">Pesquisa Rápida</label>
            <input 
              id="busca" 
              type="text" 
              v-model="form.busca" 
              placeholder="Buscar por nome, produto..." 
              class="form-control bg-light text-dark border"
            >
          </div>

          <!-- Botões de Ação -->
          <div class="col-12 col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">
              <i class="bi bi-search"></i> Filtrar
            </button>
            <button type="button" @click="limparFiltros" class="btn btn-outline-secondary" title="Limpar Filtros">
              <i class="bi bi-x-lg"></i>
            </button>
          </div>

        </form>
      </div>
    </div>

    <!-- GRID DOS GRÁFICOS (TEMA CLARO) -->
    <div class="row g-4">
      
      <!-- Gráfico de Linhas -->
      <div class="col-12 col-xl-6">
        <div class="card bg-white text-dark border shadow-sm h-100">
          <div class="card-header bg-light border-bottom">
            <h5 class="card-title mb-0 text-secondary fs-6">Evolução de Vendas</h5>
          </div>
          <div class="card-body overflow-hidden">
            <div style="height: 300px; position: relative;">
              <LineChart :chart-data="props.chartDataLine" :chart-options="chartOptionsLine" />
            </div>
          </div>
        </div>
      </div>

      <!-- Gráfico de Barras -->
      <div class="col-12 col-xl-6">
        <div class="card bg-white text-dark border shadow-sm h-100">
          <div class="card-header bg-light border-bottom">
            <h5 class="card-title mb-0 text-secondary fs-6">Desempenho Financeiro</h5>
          </div>
          <div class="card-body overflow-hidden">
            <div style="height: 300px; position: relative;">
              <BarChart :chart-data="props.chartDataBar" :chart-options="chartOptionsBar" />
            </div>
          </div>
        </div>
      </div>

    </div>
    </div>
  </Layout>
</template>

<style scoped>
/* Estilos adicionais, se necessário */
</style>