<script setup>
// import { reactive } from 'vue';
// import { router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import TextInput from '../Components/TextInput.vue';

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
    avatar: null,
    preview: null,
});

const change = (e) => {
  form.avatar = e.target.files[0];
  form.preview = URL.createObjectURL(e.target.files[0]);
};

const submitForm = () => {
    console.log('Formulario enviado');
    console.log(form);

    // router.post('/register', form);

    form.post('/register',{
        onError: () => form.reset('password', 'password_confirmation'),
    }); //Esta es la forma correcta de enviar el formulario

}

</script>


<template>
    <Head>
        <title>| Registro</title> 
    </Head>
    <div>
        <h1 class="text-3xl text-blue-900 text-center">Registrate</h1>
        
        <form class="mt-8 mx-60 space-y-6" @submit.prevent="submitForm">
            <div class="rounded-md shadow-sm -space-y-px">

                <!-- <div class="mb-2">
                    <label for="avatar">Avatar: </label>
                    <input type="file" id="avatar" @input="change" />
                    
                </div> -->

                <!-- Upload Avatar -->
                <div class="grid place-items-center">
                    <div
                    class="relative w-28 h-28 rounded-full overflow-hidden border border-slate-300"
                    >
                    <label for="avatar" class="absolute inset-0 grid content-end cursor-pointer">
                        <span class="bg-white/70 pb-2 text-center">Avatar</span>
                    </label>
                    <input type="file" @input="change" id="avatar" hidden />

                    <img
                        class="object-cover w-28 h-28"
                        :src="form.preview ?? 'storage/avatars/defaultuser.jpg'"
                    />
                    </div>

                    <p class="error mt-2">{{ form.errors.avatar }}</p>
                </div>
                <!-- End Upload Avatar -->

                <TextInput name="name" placeholder="Nombre" v-model="form.name" :message="form.errors.name" />
                <TextInput name="email" placeholder="Correo Electronico" type="email" v-model="form.email" :message="form.errors.email" />
                <TextInput name="password" placeholder="Contrasena" type="password" v-model="form.password" :message="form.errors.password" />
                <TextInput name="password_confirmation" placeholder="Confirma tu Contrasena" type="password" v-model="form.password_confirmation" />
                
            </div>
            <div class="text-sm text-gray-500">
                <p>
                    Ya tienes una cuenta? <Link :href="route('login')" class="text-blue-600 hover:text-blue-700">Ingresa</Link>
                </p>
            </div>
            
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Registrarse
                </button>
            </div>
        </form>
    </div>
    
</template>