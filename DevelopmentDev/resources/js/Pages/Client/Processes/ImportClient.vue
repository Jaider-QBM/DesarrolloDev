<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { Inertia } from '@inertiajs/inertia';

    const submit = () => {
        const formData = new FormData();
        formData.append('import_file', document.querySelector('input[type="file"]').files[0]);
        Inertia.post('/clients/import', formData);
    }
</script>

<template>
    <AppLayout title="Importar Cliente">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight" >Importar Clientes</h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="md:grid md:grid-cols-2 md:gap-6">
                            <div class="md:col-span-1 flex justify-between">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium text-gray-900">
                                        Importar Cliente
                                    </h3>

                                    <p class="mt-1 text-sm text-gray-600">
                                        La importación de un archivo Excel para registrar clientes permite a los usuarios cargar de manera eficiente grandes cantidades de datos de clientes desde un archivo Excel a un sistema o aplicación. Esto facilita la creación rápida y precisa de registros de clientes, evitando la necesidad de ingresar manualmente cada dato individualmente.
                                    </p>
                                </div>
                            </div>

                            <div class="md:col-span-1 px-4 sm:px-0">
                                <div class="mt-5 md:mt-0">
                                    <form @submit.prevent="submit">
                                        <div class="px-4 py-5 bg-white sm:p-6 shadow"  >
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span6">
                                                    <input type="file" name="import_file" class="mt-1 block w-full" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div  class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                                            <button class="text-white bg-blue-500 hover:bg-blue-700 py-2 px-4 rounded" type="submit">Importar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
