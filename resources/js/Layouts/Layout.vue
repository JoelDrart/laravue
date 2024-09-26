<script setup>
//  import { Link, Head } from '@inertiajs/vue3'; //Ya no es necesario importar Link y Head porque se importan por defecto en app.js 
// import { Link } from '@inertiajs/inertia-vue3'; 
import { route } from '../../../vendor/tightenco/ziggy/src/js';
</script>

<template>
    <Head>
        <title>LaraVue</title>
    </Head>
    
    <div class="flex flex-col min-h-screen  ">
        <header class="bg-blue-500 text-white p-4">
            <nav class="flex space-x-4">
                <div class="flex-1">
                    <!-- Primeros dos enlaces -->
                    <Link :href="route('home')" class="px-2 hover:underline">Inicio</Link>
                    <Link :href="route('about')" class="px-2 hover:underline">Acerca</Link>
                </div>
                
                <!-- Tercer enlace alineado a la derecha -->
                 <div v-if="$page.props.auth.user" class="flex">
                    <p class="">Hola, {{ $page.props.auth.user.name }} |</p>
                    <Link :href="route('logout')" method="post" as="button" type="button" class="px-2 hover:underline ml-auto">Cerrar Sesion</Link>
                 </div>
                <div v-else class="">
                    <Link :href="route('register')" class="px-2 hover:underline ml-auto">Registrate</Link>
                    <Link :href="route('login')" class="px-2 hover:underline ml-auto">Ingresa</Link>
                </div>
            </nav>
        </header>

        
        <main class="flex-grow my-4 mx-20">
            <slot></slot>
        </main>

        <footer class="bg-blue-700 text-white p-4">
            Te amo Gordita, millon de besos 😍😘💕
        </footer>
    </div>

</template>