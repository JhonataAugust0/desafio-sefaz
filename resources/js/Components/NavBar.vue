<script setup lang="ts">
import { useAuthStore } from '../stores/auth'
import { Link, router } from '@inertiajs/vue3';

const authStore = useAuthStore()

const handleLogout = () => {
  router.post(route('logout'), {}, {
    onSuccess: () => {
      authStore.logout()
    }
  })
}
</script>

<template>
  <nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">

        <a href="/">
          <h1 class="text-2xl font-bold text-primary">
            Maceió IN
          </h1>
        </a>
        </div>
        <div class="flex items-center">
          <template v-if="authStore.isAuthenticated">
            <button @click="handleLogout" class="text-xl font-bold text-primary">
                Logout
            </button>
          </template>

          <template v-else>
            <Link :href="route('login')">
                <p class="text-xl font-bold text-primary">
                    Login
                </p>
            </Link>
          </template>
        </div>
      </div>
    </div>
  </nav>
</template>
