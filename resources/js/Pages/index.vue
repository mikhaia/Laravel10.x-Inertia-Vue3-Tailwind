<script setup>
// import Layout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
 
// const props = defineProps(['user']);
</script>
 
<template>
    <Head title="User Profile" />
 
    <Layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>
 
        <div class="py-12">
            Hello, Test
        </div>
    </Layout>
</template>