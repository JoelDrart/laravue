<script setup>
// import { reactive } from 'vue';
// import { router } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import TextInput from '../Components/TextInput.vue';

const form = useForm({
    email: null,
    password: null,
    remember: null,
}); 

const submitForm = () => {
    console.log('Formulario enviado');
    console.log(form);

    // router.post('/register', form);

    form.post('/login',{
        onError: () => form.reset('password', 'remember'),
    }); //Esta es la forma correcta de enviar el formulario

}

</script>


<template>
    <Head>
        <title>| Ingreso</title> 
    </Head>
    <div>
        <h1 class="text-3xl text-blue-900 text-center">Ingresa en tu cuenta</h1>
        
        <form class="mt-8 mx-60 space-y-6" @submit.prevent="submitForm">
            <div class="rounded-md shadow-sm -space-y-px">

                <TextInput name="email" placeholder="Correo Electronico" type="email" v-model="form.email" :message="form.errors.email" />
                <TextInput name="password" placeholder="Contrasena" type="password" v-model="form.password" :message="form.errors.password" />
                                
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <input type="checkbox" v-model="form.remember" name="remember" id="remember">
                    <label for="remember">Recuerdame</label>
                </div>
                <div class="text-sm text-gray-500">
                    <p>
                        Aun no tienes una cuenta? <Link :href="route('register')" class="text-blue-600 hover:text-blue-700">Registrate</Link>
                    </p>
                </div>
            </div>
            
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Ingresa
                </button>
            </div>
        </form>
    </div>
    
</template>