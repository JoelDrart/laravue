<script setup>
const model = defineModel({
    type: null,
    required: true,
});

defineProps({
    name: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: 'text',
    },
    placeholder: {
        type: String,
        default: null,
    },
    message: {
        type: String,
    },
});

</script>
<template>
    <div>
        <div>
            <label :for="name" class="sr-only">{{ name }}</label>
            <input 
                :id="name" 
                :name="name" 
                v-model="model" 
                :type="type"  
                class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md rounded-b-md mb-1 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" 
                :class="{'border-red-600 focus:border-red-600 focus:ring-red-500': message}" 
                :placeholder="placeholder"
            >
            <small class="text-red-600" v-if="message">{{ message }}</small>
        </div>
    </div>
</template>