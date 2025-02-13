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
    async login(email: string, password: string) {
      try {
          this.user = {
          email,
          name: 'User Test'
        }
        this.isAuthenticated = true
        return true
      } catch (error) {
        console.error('Login failed:', error)
        return false
      }
    },

    logout() {
      this.user = null
      this.isAuthenticated = false
    }
  }
})
