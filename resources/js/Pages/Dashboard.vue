<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavBar from '@/Components/NavBar.vue';
import { Head } from '@inertiajs/vue3';


import { ref, computed } from 'vue'
import { useEmployeesStore } from '@/stores/empoyees'

const employeesStore = useEmployeesStore()
const searchQuery = ref('')
const showAddModal = ref(false)
const editingEmployee = ref(null)
const showDeleteModal = ref(false)
const employeeToDelete = ref(null)

const newEmployee = ref({
  name: '',
  email: '',
  sector: ''
})

const filteredEmployees = computed(() => {
  return employeesStore.employees.filter(emp =>
    emp.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    emp.email.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    emp.sector.toLowerCase().includes(searchQuery.value.toLowerCase())
  )
})

const handleSubmit = () => {
  if (editingEmployee.value) {
    employeesStore.updateEmployee(editingEmployee.value.id, newEmployee.value)
  } else {
    employeesStore.addEmployee(newEmployee.value)
  }
  closeModal()
}

const openDeleteModal = (employee) => {
  employeeToDelete.value = employee
  showDeleteModal.value = true
}

const confirmDelete = () => {
  if (employeeToDelete.value) {
    employeesStore.deleteEmployee(employeeToDelete.value.id)
    showDeleteModal.value = false
    employeeToDelete.value = null
  }
}

const closeModal = () => {
  showAddModal.value = false
  editingEmployee.value = null
  newEmployee.value = {
    name: '',
    email: '',
    sector: ''
  }
}
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
        class="input-field"
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
              <button @click="editingEmployee = employee" class="text-secondary hover:text-secondary mr-2">Editar</button>
              <button @click="openDeleteModal(employee)" class="text-red-600 hover:text-red-900">Excluir</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-if="showAddModal || editingEmployee" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
      <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <h2 class="text-2xl font-bold text-primary mb-4">
          {{ editingEmployee ? 'Editar' : 'Adicionar' }} Funcionário
        </h2>

        <form @submit.prevent="handleSubmit" class="space-y-4">
          <div>
            <label class="form-label">Nome</label>
            <input type="text" v-model="newEmployee.name" class="input-field" required />
          </div>

          <div>
            <label class="form-label">Email</label>
            <input type="email" v-model="newEmployee.email" class="input-field" required />
          </div>

          <div>
            <label class="form-label">Setor</label>
            <select v-model="newEmployee.sector" class="input-field" required>
              <option value="">Selecione um setor</option>
              <option v-for="sector in employeesStore.sectors" :key="sector" :value="sector">
                {{ sector }}
              </option>
            </select>
          </div>

          <div class="flex justify-end space-x-2 mt-6">
            <button type="button" @click="closeModal" class="px-4 py-2 border rounded-md">
              Cancelar
            </button>
            <button type="submit" class="btn-primary">
              {{ editingEmployee ? 'Salvar' : 'Adicionar' }}
            </button>
          </div>
        </form>
      </div>
    </div>

    <div v-if="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
      <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <h2 class="text-2xl font-bold text-primary mb-4">Confirmar Exclusão</h2>
        <p class="mb-6">Tem certeza que deseja excluir este funcionário?</p>

        <div class="flex justify-end space-x-2">
          <button @click="showDeleteModal = false" class="px-4 bg-white-100 hover:bg-gray-200 py-2 border rounded-md">
            Cancelar
          </button>
          <button @click="confirmDelete" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
            Excluir
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
