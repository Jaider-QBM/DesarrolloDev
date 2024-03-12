<script setup>
    import { useForm } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';
    import CompaniesForm from '@/Components/Companies/Form.vue';

    const form = useForm({
        nit:'',
        nameCompany:'',
        descriptionCompany:'',
        industryCompany:'',
        LocationCompany:'',
        numberCompany:'',
        photo_logo:'',
    })
</script>
<template>
    <AppLayout title="Crear Compañia">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight" >Crear Compañia</h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <CompaniesForm :form="form" @submit="form.post(route('companies.store'))"/>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
