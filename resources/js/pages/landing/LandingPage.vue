<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
        <Navbar />
        <UContainer>
            <Header />
        </UContainer>
    </div>
</template>

<script setup lang="ts">
import Header from './components/Header.vue';
import Navbar from './components/Navbar.vue';
</script>
