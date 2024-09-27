<script setup>

</script>
<template>
    <Head>
        <title>| Dashboard</title>
    </Head>
    <div>
        <p class="p-4 bg-green-400 text-slate-800">{{ $page.props.flash.message }}</p>
        <h1>Bienvenido {{ $page.props.auth.user.name }}</h1>
    </div>
</template>