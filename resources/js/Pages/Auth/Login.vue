<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<!-- <script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { useAuthStore } from '@/stores/auth'

import GuestLayout from '@/Layouts/GuestLayout.vue';


const authStore = useAuthStore()

const email = ref('')
const password = ref('')
const error = ref('')

const handleSubmit = async () => {
  if (!email.value || !password.value) {
    error.value = 'Por favor, preencha todos os campos'
    return
  }

  if (!email.value.includes('@')) {
    error.value = 'Por favor, insira um email válido'
    return
  }

  const success = await authStore.login(email.value, password.value)
  if (success) {
    router.visit('/dashboard')
  } else {
    error.value = 'Credenciais inválidas'
  }
}
</script>

<template>
        <div class="min-h-[calc(100vh-4rem)] flex items-center justify-center bg-gray-50">
            <div class="max-w-md w-full mx-4">
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-3xl font-bold text-primary mb-6 text-center">Login</h2>

                <form @submit.prevent="handleSubmit" class="space-y-4">
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input
                    id="email"
                    type="email"
                    v-model="email"
                    class="input-field"
                    required
                    />
                </div>

                <div>
                    <label for="password" class="form-label">Senha</label>
                    <input
                    id="password"
                    type="password"
                    v-model="password"
                    class="input-field"
                    required
                    />
                </div>

                <div v-if="error" class="text-red-500 text-sm mt-2">
                    {{ error }}
                </div>

                <button type="submit" class="btn-primary w-full mt-6">
                    Entrar
                </button>
                </form>
            </div>
            </div>
        </div>
</template> -->

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 block">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600"
                        >Remember me</span
                    >
                </label>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
