<script setup>
  // Importaciones necesarias
  import AppLayout from '@/Layouts/AppLayout.vue';
  import { Inertia } from '@inertiajs/inertia';
  import { ref, computed } from 'vue';
  import { Link } from '@inertiajs/vue3';
  import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
  import { library } from '@fortawesome/fontawesome-svg-core';
  import { faPencilAlt, faTrash, faUserPlus, faFileUpload } from '@fortawesome/free-solid-svg-icons';

  library.add(faPencilAlt, faTrash, faUserPlus, faFileUpload);

  // Define las propiedades del componente usando defineProps
  const { clients } = defineProps(['clients']);

  const deleteClient = (clientId) => {
    if (confirm('¿Está seguro de eliminar este Cliente?')) {
      Inertia.delete(`/clients/${clientId}`);
    }
  };

  const selectedClient = ref(null);

  const openModal = (client) => {
    selectedClient.value = client;
  };

  const closeModal = () => {
    selectedClient.value = null;
  };

  const filter = ref('');

  const filteredClients = computed(() => {
    if (!clients.data) {
      return [];
    }
    const searchTerm = filter.value.toLowerCase();

    return clients.data.filter((client) =>
      client.name.toLowerCase().includes(searchTerm) ||
      client.phone_number.toString().includes(searchTerm) ||
      client.document_number.toString().includes(searchTerm)
    );
  });



</script>

<template>

    <AppLayout title="Clientes">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Clientes</h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between ">
                        <Link :href="route('users.create')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" v-if="$page.props.user.permissions.includes('create user')" title="Crear un nuevo cliente deseado">
                            <font-awesome-icon icon="user-plus" />
                        </Link>
                          <!-- filtrar -->
                            <div class="w-80">
                                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                    </div>
                                    <input
                                        type="search"
                                        v-model="filter"
                                        class="block w-full p-2/2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Busca cliente que quieras"
                                        required
                                    />
                                </div>
                            </div>
                            <!-- fin de filtrar -->

                        <Link :href="route('users.importClient')" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" v-if="$page.props.user.permissions.includes('import user')" title="Importar un archivo Excel">
                            <font-awesome-icon icon="file-upload" />
                        </Link>

                    </div>
                    <div class="mt-6">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nombres
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Apellidos
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Numero Telefonico
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tipo de Documento
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Numero de Documento
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">acciones</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">vermas</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                        <!-- filtrar  -->
                                <tr v-if="filteredClients.length === 0">
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">No hay clientes disponibles</td>
                                </tr>
                                <tr v-for="client in filteredClients" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <!-- ... (resto de tu fila de datos) -->
                                </tr>



                                    <tr v-for="client in filteredClients" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ client.id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ client.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ client.lastname }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ client.phone_number }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ client.document_type }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ client.document_number }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <Link :href="route('users.edit', client.id )" class="mr-5 font-medium text-blue-600 dark:text-blue-500 hover:underline" title="Editar Cliente">
                                            <font-awesome-icon icon="pencil-alt" />
                                        </Link>
                                        <Link @click="deleteClient(client.id)" class="font-medium text-red-600 dark:text-blue-500 hover:underline" title="Eliminar Cliente">
                                            <font-awesome-icon icon="trash" />
                                        </Link>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <button @click="openModal(client)" class="text-blue-600 hover:underline" title="Ver Detalles">
                                            Ver mas
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-if="selectedClient" class="fixed inset-0 overflow-y-auto flex items-center justify-center">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 p-8 w-10 md:w-2/4 lg:w-2/4 xl:w-1/3">
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Detalles del Cliente
                                    </h3>
                                    <button  @click="closeModal" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>

                                <div class="p-4 md:p-5 space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                        <p class="md:col-span-2">ID cliente: {{ selectedClient.id }}</p>
                                        <p class="md:col-span-2">Nombres: {{ selectedClient.name }}</p>
                                        <p class="md:col-span-2">Apellidos: {{ selectedClient.lastname }}</p>
                                        <p class="md:col-span-2">Numero Telefonico: {{ selectedClient.phone_number }}</p>
                                        <p class="md:col-span-2">Tipo Documento {{ selectedClient.document_type }}</p>
                                        <p class="md:col-span-2">Número de documento: {{ selectedClient.document_number }}</p>
                                        <p class="md:col-span-2">Correo Electronico: {{ selectedClient.email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>

</template>
