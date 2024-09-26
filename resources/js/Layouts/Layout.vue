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
            <nav class="flex space-x-4 justify-between">
                <div class="flex">
                    <!-- Primeros dos enlaces -->
                    <Link :href="route('home')" class="p-2 rounded-md  mx-2 hover:bg-blue-600" :class="{'bg-blue-800' : $page.component === 'Home'}">Inicio</Link>
                    <Link :href="route('about')" class="p-2 rounded-md mx-2 hover:bg-blue-600" :class="{'bg-blue-800' : $page.component === 'About'}">Acerca</Link>
                </div>
                
                <!-- Tercer enlace alineado a la derecha -->
                <div v-if="$page.props.auth.user" class="flex">
                    <img 
                    class="w-8 h-8 rounded-full mt-auto mb-auto border-2 border-white"
                    :src="'storage/' + $page.props.auth.user.avatar" 
                    alt="">

                    <Link 
                        :href="route('dashboard')" 
                        class="p-2 rounded-md hover:bg-blue-600  mx-2"
                        :class="{'bg-blue-800' : $page.component === 'Dashboard'}"
                    >
                        Dashboard
                    </Link>
                    <Link :href="route('logout')" method="post" as="button" type="button" class="p-2 rounded-md hover:bg-blue-600 ml-auto">Cerrar Sesion</Link>
                </div>
                <div v-else class="flex">
                    <Link :href="route('register')" class="p-2 rounded-md hover:bg-blue-600  mx-2" :class="{'bg-blue-800' : $page.component === 'Auth/Register'}">Registrate</Link>
                    <Link :href="route('login')" class="p-2 rounded-md hover:bg-blue-600 mx-2" :class="{'bg-blue-800' : $page.component === 'Auth/Login'}">Ingresa</Link>
                </div>
            </nav>
        </header>

        
        <main class="flex-grow my-4 mx-20">
            <slot></slot>
        </main>

        <footer class="bg-blue-700 text-white p-4 text-center">
            Te amo Gordita, millon de besos 😍😘💕
        </footer>
    </div>

</template>