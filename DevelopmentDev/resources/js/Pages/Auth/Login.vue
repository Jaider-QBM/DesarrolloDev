<script setup>
    import { Head, Link, useForm } from '@inertiajs/vue3';
    import AuthenticationCard from '@/Components/AuthenticationCard.vue';
    import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
    import Checkbox from '@/Components/Checkbox.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { library } from '@fortawesome/fontawesome-svg-core';
    import { faGoogle, faFacebook } from '@fortawesome/free-brands-svg-icons';

    library.add(faGoogle, faFacebook);


    defineProps({
        canResetPassword: Boolean,
        status: String,
    });

    const form = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = () => {
        form.transform(data => ({
            ...data,
            remember: form.remember ? 'on' : '',
        })).post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };

    const openGoogleAuthPopup = () => {
        window.open(route('users.initGoogle'));
    };
</script>

<template>
    <Head title="Iniciar Sesion" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Correo Electronico" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
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
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Recordar Datos</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    ¿Olvidaste tu contraseña?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Iniciar Sesion
                </PrimaryButton>
            </div>
        </form>

        <div class="flex justify-center items-center mt-4">
            <div class="w-full h-px bg-slate-400"></div>
            <div class="text-center text-slate-400 ml-3 mr-3">o</div>
            <div class="w-full h-px bg-slate-400"></div>
        </div>

        <div class="flex justify-around mt-5">
            <a :href="route('users.initGoogle')" @click.prevent="openGoogleAuthPopup" class="border border-slate-400 w-40 py-2 text-center rounded">
                <font-awesome-icon class="fa-lg text-blue-400" :icon="['fab', 'google']" />
                <span class="ml-2">Google</span>
            </a>

            <Link class="border border-slate-400 w-40 py-2 text-center rounded hover:bg-blue-500 hover:border-blue-500 text-blue-500 hover:text-white">
                <font-awesome-icon class="fa-lg" :icon="['fab', 'facebook']" />
                <span class="ml-2">Facebook</span>
            </Link>
        </div>

    </AuthenticationCard>
</template>
