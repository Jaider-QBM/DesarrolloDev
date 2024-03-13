<script setup>
    import { useForm } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import ClientForm from '@/Components/Clients/Form.vue';
    import { ref } from 'vue';


    // const user = ref($props.user);

//


    const { user } = defineProps(['user']);
const form = useForm({
    name: user.name,
    lastname: user.lastname,
    phone_number: user.phone_number,
    document_type: user.document_type,
    document_number: user.document_number,
    email: user.email,
    password: user.password
});

</script>

<template>
    <AppLayout title="Editar Cliente">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight" >Editar Clientes</h1>
        </template>
        <div class="py-12">
            <!-- <input v-model="user.name" type="text" /> -->
            <div class="max-w-7xl mx-auto sm:px:6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <ClientForm :updating="true" :form="form" @submit="form.put(route('users.update', user.id))"/>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
