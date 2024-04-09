<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import FormDocuments from '@/Components/Documents/Form.vue';

const props = defineProps({
    form: {
        type: Object,
        required: true
    },
    companies: {
        type: Object,
        required: true
    },
    users: {
        type: Object,
        required: true
    },
});

    const form = useForm({
        company_id:props.companies.id,
        document_type: '',
        url_document: '',
        review_status:''
    })

</script>

<template>
    <AppLayout title="Documentos">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Documentos De Compañia</h1>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <FormDocuments :form="form" :companies="companies" :users="users" @submit="form.post(route('documents.store', companies.id))" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
