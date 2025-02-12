<script setup lang="ts">
const activities = [
  {
    icon: '💰',
    title: 'Gestão Tributária',
    description: 'Administração e controle dos tributos municipais, incluindo IPTU, ISS e taxas municipais. Facilitamos o cumprimento das obrigações fiscais dos contribuintes.'
  },
  {
    icon: '📊',
    title: 'Contabilidade Pública',
    description: 'Registro e controle contábil das receitas e despesas municipais, garantindo transparência e conformidade com as normas de contabilidade pública.'
  },
  {
    icon: '🏦',
    title: 'Tesouro Municipal',
    description: 'Gestão dos recursos financeiros do município, incluindo pagamentos, recebimentos e aplicações financeiras para otimizar os recursos públicos.'
  },
  {
    icon: '📋',
    title: 'Fiscalização',
    description: 'Monitoramento e controle das atividades econômicas do município, combate à sonegação fiscal e promoção da justiça tributária.'
  }
]
</script>

<template>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div v-for="activity in activities" :key="activity.title"
           class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
        <div class="flex items-start space-x-4">
          <span class="text-4xl">{{ activity.icon }}</span>
          <div>
            <h3 class="text-xl font-semibold text-secondary mb-2">
              {{ activity.title }}
            </h3>
            <p class="text-gray-600">
              {{ activity.description }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
