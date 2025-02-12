import { defineStore } from 'pinia'
import { router, usePage } from '@inertiajs/vue3'

interface Employee {
  id: number;
  name: string;
  sector: string;
  email: string;
}

export const useEmployeesStore = defineStore('employees', {
    state: () => ({
      employees: usePage().props.employees as Employee[],
      sectors: usePage().props.sectors as string[]
    }),

    actions: {
      async updateEmployee(id: number, data: Partial<Employee>) {
        return router.patch(route('employee.update'), { id, ...data }, {
          onSuccess: () => {}
        });
      },

      async deleteEmployee(id: number) {
        return router.delete(route('employee.destroy'), {
          data: { id },
          onSuccess: () => {}
        });
      },

      async fetchEmployees() {
        return router.get(route('dashboard'));
      },
    }
});
