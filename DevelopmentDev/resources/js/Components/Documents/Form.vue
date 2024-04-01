<script setup>
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

    defineEmits(['submit'])
</script>

<template>
        <FormSection  @submitted="$emit('submit')" enctype="multipart/form-data">
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
                    <InputError class="mt-2" :message="form.errors.kind_person" />
                </div>
                <div class="mt-4">
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-50 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Haga clic para</span> cargar o arrastre y suelte</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PDF</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>
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
                    <InputError class="mt-2" :message="form.errors.kind_person" />
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


