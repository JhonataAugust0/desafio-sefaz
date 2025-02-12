<script setup>
import { usePage, Head, useForm } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue'
import { useEmployeesStore } from '@/stores/employees'
import NavBar from '@/Components/NavBar.vue';

const props = defineProps({
    employees: {
        type: Array,
        default: () => []
    },
    sectors: {
        type: Array,
        default: () => []
    }
});

const employeesStore = useEmployeesStore();
const searchQuery = ref('');
const showAddModal = ref(false);
const showDeleteModal = ref(false);
const showEditModal = ref(false);
const employeeToEdit = ref(null);
const employeeToDelete = ref(null);

onMounted(() => {
    employeesStore.$patch({
        employees: props.employees,
        sectors: props.sectors
    });
});

const form = useForm({
    name: '',
    email: '',
    sector: '',
});

const editForm = useForm({
    id: '',
    name: '',
    email: '',
    sector: ''
});

const deleteForm = useForm({id: ''});

const filteredEmployees = computed(() => {
    return employeesStore.employees.filter(emp =>
        emp.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        emp.email.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        emp.sector.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const handleSubmit = () => {
    form.post(route('employee.store'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
            form.reset();
            employeesStore.$patch({
                employees: usePage().props.employees
            });
        },
    });
};

const openDeleteModal = (employee) => {
    deleteForm.id = employee.id;
    employeeToDelete.value = employee;
    showDeleteModal.value = true;
};

const openEditModal = (employee) => {
    employeeToEdit.value = employee;
    editForm.id = employee.id;
    editForm.name = employee.name;
    editForm.email = employee.email;
    editForm.sector = employee.sector;
    showEditModal.value = true;
};

const confirmDelete = () => {
    console.log(employeeToDelete.value.id);
    if (employeeToDelete.value) {
        deleteForm.delete(route('employee.destroy', { id: employeeToDelete.value.id }), {
            preserveScroll: true,
            onSuccess: () => {
                showDeleteModal.value = false;
                employeeToDelete.value = null;
                employeesStore.$patch({
                    employees: usePage().props.employees
                });
            },
        });
    }
};

const confirmEdit = () => {
    if (employeeToEdit.value) {
        editForm.patch(route('employee.update'), {
            preserveScroll: true,
            onSuccess: () => {
                showEditModal.value = false;
                employeeToEdit.value = null;
                editForm.reset();
                employeesStore.$patch({
                    employees: usePage().props.employees
                });
            },
        });
    }
};

const closeModal = () => {
    showAddModal.value = false;
    showEditModal.value = false;
    showDeleteModal.value = false;
    employeeToEdit.value = null;
    employeeToDelete.value = null;
    form.reset();
    editForm.reset();
};
</script>

<template>
    <Head title="Dashboard" />
    <NavBar />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-primary">Funcionários</h1>
            <button @click="showAddModal = true" class="btn-primary">
                Adicionar Funcionário
            </button>
        </div>

        <div class="mb-4">
            <input
                type="text"
                v-model="searchQuery"
                placeholder="Pesquisar funcionários..."
                class="input-field w-full"
            />
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Setor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="employee in filteredEmployees" :key="employee.id">
                        <td class="px-6 py-4 whitespace-nowrap">{{ employee.name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ employee.sector }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ employee.email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button @click="openEditModal(employee)" class="text-secondary hover:text-blue-950 mr-2">
                                Editar
                            </button>
                            <button @click="openDeleteModal(employee)" class="text-red-600 hover:text-red-900">
                                Excluir
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="showAddModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg p-6 max-w-md w-full">
                <h2 class="text-2xl font-bold text-primary mb-4">Adicionar Funcionário</h2>
                <form @submit.prevent="handleSubmit" class="space-y-4">
                    <div>
                        <label class="form-label">Nome</label>
                        <input type="text" v-model="form.name" class="input-field w-full" required />
                        <div v-if="form.errors.name" class="text-red-500 text-sm">{{ form.errors.name }}</div>
                    </div>

                    <div>
                        <label class="form-label">Email</label>
                        <input type="email" v-model="form.email" class="input-field w-full" required />
                        <div v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</div>
                    </div>

                    <div>
                        <label class="form-label">Setor</label>
                        <select v-model="form.sector" class="input-field w-full" required>
                            <option value="">Selecione um setor</option>
                            <option v-for="sector in employeesStore.sectors" :key="sector" :value="sector">
                                {{ sector }}
                            </option>
                        </select>
                        <div v-if="form.errors.sector" class="text-red-500 text-sm">{{ form.errors.sector }}</div>
                    </div>

                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" @click="closeModal" class="btn-secondary">
                            Cancelar
                        </button>
                        <button type="submit" class="btn-primary" :disabled="form.processing">
                            Adicionar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg p-6 max-w-md w-full">
                <h2 class="text-2xl font-bold text-primary mb-4">Editar Funcionário</h2>
                <form @submit.prevent="confirmEdit" class="space-y-4">
                    <div>
                        <label class="form-label">Nome</label>
                        <input type="text" v-model="editForm.name" class="input-field w-full" required />
                        <div v-if="editForm.errors.name" class="text-red-500 text-sm">{{ editForm.errors.name }}</div>
                    </div>

                    <div>
                        <label class="form-label">Email</label>
                        <input type="email" v-model="editForm.email" class="input-field w-full" required />
                        <div v-if="editForm.errors.email" class="text-red-500 text-sm">{{ editForm.errors.email }}</div>
                    </div>

                    <div>
                        <label class="form-label">Setor</label>
                        <select v-model="editForm.sector" class="input-field w-full" required>
                            <option value="">Selecione um setor</option>
                            <option v-for="sector in employeesStore.sectors" :key="sector" :value="sector">
                                {{ sector }}
                            </option>
                        </select>
                        <div v-if="editForm.errors.sector" class="text-red-500 text-sm">{{ editForm.errors.sector }}</div>
                    </div>

                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" @click="closeModal" class="btn-secondary">
                            Cancelar
                        </button>
                        <button type="submit" class="btn-primary" :disabled="editForm.processing">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg p-6 max-w-md w-full">
                <h2 class="text-2xl font-bold text-primary mb-4">Confirmar Exclusão</h2>
                <p class="mb-6">Tem certeza que deseja excluir este funcionário?</p>

                <div class="flex justify-end space-x-2">
                    <button @click="showDeleteModal = false" class="btn-secondary">
                        Cancelar
                    </button>
                    <button @click="confirmDelete" class="btn-danger">
                        Excluir
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
