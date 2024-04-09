<script setup>
    import { useForm } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import RoleForm from '@/Components/Role/Form.vue';
    import { ref } from 'vue';

    const props = defineProps({
        role: {
            type: Object,
            required: true
        },
        permissions: {
            type: Object,
            required: true
        }
    });

    // Inicializa el formulario usando useForm y establece las propiedades del rol
    const form = useForm({
        name: props.role.name || '', // Si props.role.name es undefined, asigna una cadena vacía
        permissions: props.role.permissions ? props.role.permissions.map(permission => permission.id) : [] // Si props.role.permissions es undefined, asigna un arreglo vacío
    });

    // Define una función para manejar la actualización del rol
    const updateRole = () => {
        form.put(route('roles.update', props.role.id)); // Envía la solicitud de actualización del rol
    }
</script>


<template>
    <AppLayout title="Editar Cliente">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight" >Editar Roles</h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px:6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <RoleForm :updating="true" :form="form" :permissions="permissions" @submit="updateRole"/>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

