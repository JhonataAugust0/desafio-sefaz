<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import NavBar from '@/Components/NavBar.vue';
import ActivityCards from '@/Components/ActivityCards.vue'

</script>

<template>
    <NavBar />
    <div class="min-h-[calc(100vh-4rem)] bg-cover bg-center flex items-center" style="background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), url('https://www.maceio.al.gov.br/wp-content/uploads/2021/01/maceio-alagoas.jpg')">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h1 class="text-4xl font-bold text-primary mb-6">
        Secretaria Municipal da Fazenda de Maceió
      </h1>
      <p class="text-lg text-gray-700 mb-8">
        A Secretaria Municipal da Fazenda de Maceió é responsável pela administração financeira, contábil e tributária do município de Maceió. Nosso compromisso é com a transparência e eficiência na gestão dos recursos públicos.
      </p>

      <Link :href="route('login')">
        <button class="btn-primary text-lg">
            Acessar sistema
        </button>
      </Link>
      <ActivityCards />
    </div>
  </div>
</template>
