import { defineStore } from 'pinia'

interface Employee {
  id: number;
  name: string;
  sector: string;
  email: string;
}

export const useEmployeesStore = defineStore('employees', {
  state: () => ({
    employees: [] as Employee[],
    sectors: ['Contabilidade', 'Financeiro', 'Atendimento', 'Orçamento', 'TI']
  }),

  actions: {
    addEmployee(employee: Omit<Employee, 'id'>) {
      const newEmployee = {
        id: Date.now(),
        ...employee
      }
      this.employees.push(newEmployee)
    },

    updateEmployee(id: number, data: Partial<Employee>) {
      const index = this.employees.findIndex(emp => emp.id === id)
      if (index !== -1) {
        this.employees[index] = { ...this.employees[index], ...data }
      }
    },

    deleteEmployee(id: number) {
      this.employees = this.employees.filter(emp => emp.id !== id)
    }
  }
})
