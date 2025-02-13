import { defineStore } from 'pinia'

interface User {
  email: string;
  name: string;
}

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null as User | null,
    isAuthenticated: false
  }),

  actions: {
    logout() {
      this.user = null
      this.isAuthenticated = false
    }
  }
})
