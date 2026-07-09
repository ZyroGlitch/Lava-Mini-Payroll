<script setup>
import Layout from '../Layouts/Navbar.vue';

defineOptions({
    layout: Layout
})

defineProps({
    user: String
})
</script>

<template>
    <div>
        <h1 class="text-success">Welcome, {{ user }}!</h1>
        <p>This is a simple landing page for the payroll application.</p>
    </div>
</template>
