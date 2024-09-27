<script setup>
import { Head, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { debounce } from 'lodash';

 const props = defineProps({
    users: Object,
    searchTerm: String
});

const search = ref(props.searchTerm);

// watch(search, (value) => router.get('/about', { search: value }, { preserveState: true }));

watch(search, debounce( 
    (value) => router.get('/about', { search: value }, { preserveState: true }),
    500
)
);

const getDate = (date) => {
    return new Date(date).toLocaleDateString("es-ES", {
        year: "numeric",
        month: "long",
        day: "numeric"
    });
}
</script>


<template>
    <Head>
        <title>| Acerca</title>
    </Head>
    <div class="container mx-auto overflow-x-auto">
        <h1 class="text-3xl text-blue-900 text-center">About Us</h1>
        <p >Lista de usuarios</p>
        <br>
    </div>  
    <div class="container mx-auto overflow-x-auto">

        <div class="flex justify-end mb-4">
            <div class="w-1/4">
                <input type="search" placeholder="Buscar" 
                class="p-2 border-slate-700 border-2 rounded-md shadow-md"
                v-model="search"
                >
            </div>
        </div>

        <table class="min-w-full bg-white rounded-md border border-gray-300 shadow-md">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-2 px-4 rounded-md border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700">Foto</th>
                    <th class="py-2 px-4 rounded-md border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700">Nombre</th>
                    <th class="py-2 px-4 rounded-md border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700">Correo</th>
                    <th class="py-2 px-4 rounded-md border-b-2 border-gray-300 text-left text-sm font-semibold text-gray-700">Fecha de registro</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.data" :key="user.id" class="hover:bg-gray-100 odd:bg-white even:bg-slate-50">
                    <td class="py-2 px-4 border-b rounded-md border-gray-300">
                        <img :src="'storage/' + user.avatar" class="w-10 h-10 rounded-full" alt="User Avatar">
                    </td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ user.name }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ user.email }}</td>
                    <td class="py-2 px-4 border-b border-gray-300">{{ getDate(user.created_at) }}</td>
                </tr>
            </tbody>

        </table>
        <!-- Links de paginacion -->
        <div class=" flex m-2 p-2 flex-col items-end">
            <div>
                <Link v-for="link in users.links" 
                :key="link.label"
                v-html="link.label"
                :href="link.url"
                class="m-1 px-2 py-1 bg-blue-400 text-white rounded-md hover:bg-blue-700"
                :class="{'bg-red-300 text-slate-950': link.active, 'bg-indigo-100':!link}"
                >
                
                </Link>

            </div>
            <p class="m-2">
                Mostrando {{ users.from }} al {{ users.to }} de {{ users.total }} resultados disponibles
            </p>

            

        </div>
    </div>
</template>