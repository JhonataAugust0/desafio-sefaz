import { defineStore } from 'pinia'
import { usePage, router } from '@inertiajs/vue3'

interface Employee {
  id: number;
  name: string;
  sector: string;
  email: string;
}

export const useEmployeesStore = defineStore('employees', {
    state: () => ({
        employees: [] as Employee[],
        sectors: [] as string[]
    }),

    getters: {
        getEmployees: (state) => state.employees || [],
        getSectors: (state) => state.sectors || []
    },

    actions: {
        initialize() {
            const page = usePage();
            if (page.props.employees) {
                this.employees = page.props.employees;
            }
            if (page.props.sectors) {
                this.sectors = page.props.sectors;
            }
        },

        async updateEmployee(id: number, data: Partial<Employee>) {
            return router.patch(route('employee.update'),
                { id, ...data },
                {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.initialize();
                    }
                }
            );
        },

        async deleteEmployee(id: number) {
            return router.delete(route('employee.destroy'),
                {
                    data: { id },
                    preserveScroll: true,
                    onSuccess: () => {
                        this.initialize();
                    }
                }
            );
        }
    }
});
