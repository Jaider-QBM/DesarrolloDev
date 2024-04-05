<script setup>
import { defineProps, defineEmits } from 'vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

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
    }
});

const emit = defineEmits(['submit']);

const handleFileChange = (event) => {
    // Accede a form a través de props y asigna el archivo seleccionado
    props.form.url_document = event.target.files[0];
};

const handleSubmit = () => {
    // Aquí, deberías manejar la lógica de presentación del formulario
    // Por ejemplo, podrías querer validar el formulario y luego emitir un evento al componente padre
    emit('submit');
};
</script>

<template>
    <FormSection @submit="handleSubmit" enctype="multipart/form-data">
        <template #title>
            Documentos de {{ props.companies.nameCompany }}
        </template>
        <template #description>
            Cliente Juridico {{ props.users.name }} {{ props.users.lastname }}
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span6">
                <div class="mt-4">
                    <label for="document_type" class="block text-sm font-medium text-gray-700">Tipo de Documento</label>
                    <select id="document_type" v-model="form.document_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required autofocus>
                        <option value="" disabled selected>Selecciona</option>
                        <option value="D.C">Constitución</option>
                        <option value="D.P">Propiedad</option>
                        <option value="D.F">Fiscales</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors && form.errors.document_type" />
                </div>
                <div class="mt-4">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Sube archivos PDF</label>
                    <input type="file" name="url_document" @change="handleFileChange">
                </div>
                <div class="mt-4">
                    <label for="review_status" class="block text-sm font-medium text-gray-700">Estado del Documento</label>
                    <select id="review_status" v-model="form.review_status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required autofocus>
                        <option value="" disabled selected>Selecciona</option>
                        <option value="revisado">Revisando</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="en_revision">En Revision</option>
                        <option value="rechazado">Rechazado</option>
                        <option value="aprovado">Aprovado</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors && form.errors.review_status" />
                </div>
            </div>
        </template>

        <template #actions>
            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                <h3>Registrar</h3>
            </PrimaryButton>
        </template>
    </FormSection>
</template>
