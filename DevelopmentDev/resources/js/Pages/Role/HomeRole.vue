<script setup>
    import { ref } from 'vue';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Inertia } from '@inertiajs/inertia';
    import { Link } from '@inertiajs/vue3';
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { library } from '@fortawesome/fontawesome-svg-core';
    import { faPencilAlt, faTrash, faUserPlus  } from '@fortawesome/free-solid-svg-icons';

    library.add(faPencilAlt, faTrash, faUserPlus);

    defineProps({
        roles:{
            type: Object,
            required: true
        }
    })

    const selectedRol = ref(null);

    const openModal = (permissions) => {
        selectedRol.value = permissions;
    };

    const closeModal = () => {
        selectedRol.value = null;
    };

    const deleteRole = (roleId) => {
        if (confirm('¿Estás seguro de eliminar este Rol?')) {
            Inertia.delete(`/roles/${roleId}`)
        }
    };
</script>


<template>
    <AppLayout title="Roles">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between">
                        <Link :href="route('roles.create')"  class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" v-if="$page.props.user.permissions.includes('create roles')" title="Crear un rol deseado">
                            <font-awesome-icon icon="user-plus" />
                        </Link>
                    </div>
                    <div class="mt-4">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        id
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nombre
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Permisos
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">acciones</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="rol in roles" :key="roles.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ rol.id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ rol.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <button @click="openModal(rol.permissions)" class="text-blue-600 hover:underline" title="Ver Detalles">
                                            Ver mas
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <Link :href="route('roles.edit', rol.id )" class="mr-5 font-medium text-blue-600 dark:text-blue-500 hover:underline" title="Editar Rol">
                                            <font-awesome-icon icon="pencil-alt" />
                                        </Link>

                                        <Link @click="deleteRole(rol.id)" class="font-medium text-red-600 dark:text-blue-500 hover:underline" title="Eliminar Rol">
                                            <font-awesome-icon icon="trash" />
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div v-if="selectedRol" class="fixed inset-0 overflow-y-auto flex items-center justify-center">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 p-8 w-10 md:w-2/4 lg:w-2/4 xl:w-1/3">
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Permisos del Rol
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
                                        <p class="bg-green-500/10 p-2 rounded-xl text-green-500 hover:transform hover:scale-105 text-center " v-for="permission in selectedRol" :key="permission.id">{{ permission.name }}</p>
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
