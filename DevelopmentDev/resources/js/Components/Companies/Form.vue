<script setup>
    import FormSection from '@/Components/FormSection.vue';
    import TextInput from '@/Components/TextInput.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';

    defineProps({
        form: {
            type: Object,
            required: true
        },
        updating:{
            type: Boolean,
            default: false
        }
    })

    defineEmits(['submit'])
</script>

<template>
    <FormSection @submitted="$emit('submit')">
        <template #title>
            {{ updating ? 'Actualizar Compañia' : 'Crear Nueva Compañia' }}
        </template>
        <template #description>
            {{ updating ? 'Actualizar Compañia existente' : 'Crear un nueva Compañia' }}
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span6">
                <div>
                    <InputLabel for="nit" value="Nit" title="Número de identificación tributaria" />
                    <TextInput
                        id="nit"
                        v-model="form.nit"
                        type="number"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="nit"
                    />
                    <InputError class="mt-2" :message="form.errors.nit" />
                </div>
                <div class="mt-4">
                    <InputLabel for="nameCompany" value="Nombre" />
                    <TextInput
                        id="nameCompany"
                        v-model="form.nameCompany"
                        type="text"
                        rows="4"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="nameCompany"
                    />
                    <InputError class="mt-2" :message="form.errors.nameCompany" />
                </div>
                <div class="mt-4">
                    <InputLabel for="descriptionCompany" class="block mb-2 text-sm font-medium text-gray-900">Descripción</InputLabel>
                    <textarea
                        id="descriptionCompany"
                        v-model="form.descriptionCompany"
                        rows="4"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                        placeholder="Descripción de la compañía...">
                    </textarea>
                    <InputError class="mt-2" :message="form.errors.descriptionCompany" />
                </div>

                <div class="mt-4">
                    <InputLabel for="numberCompany" value="Numero de Telefono" />
                    <TextInput
                        id="numberCompany"
                        v-model="form.numberCompany"
                        type="number"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="numberCompany"
                    />
                    <InputError class="mt-2" :message="form.errors.numberCompany" />
                </div>

                <div class="mt-4">
                    <label for="industryCompany" class="block text-sm font-medium text-gray-700">Tipo de Industria</label>
                    <select id="industryCompany" v-model="form.industryCompany" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required autofocus>
                        <option value="" disabled selected>Selecciona</option>
                        <option value="manufacturera">Manufacturera</option>
                        <option value="alimentaria">Alimentaria</option>
                        <option value="tecnológica">Tecnológica</option>
                        <option value="automotriz">Automotriz</option>
                        <option value="farmacéutica">Farmacéutica</option>
                        <option value="energética">Energética</option>
                        <option value="construcción">Construcción</option>
                        <option value="entretenimiento">Entretenimiento</option>
                        <option value="turismo">Turismo</option>
                        <option value="financiera">Financiera</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.kind_person" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Correo Electronico" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Contraseña" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

            </div>
        </template>

        <template #actions>
            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ updating ? 'Actualizar' : 'Registrar' }}
            </PrimaryButton>
        </template>
    </FormSection>

</template>
