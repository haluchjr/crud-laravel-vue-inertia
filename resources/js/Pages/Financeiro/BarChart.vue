<script setup>
import { Bar } from 'vue-chartjs'
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
} from 'chart.js'

// É obrigatório registrar os módulos do Chart.js que o gráfico de barras utiliza
ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
)

defineProps({
  chartData: {
    type: Object,
    required: true
  },
  chartOptions: {
    type: Object,
    default: () => ({
      responsive: true,
      maintainAspectRatio: false
    })
  }
})
</script>

<template>
  <Bar :data="chartData" :options="chartOptions" />
</template>