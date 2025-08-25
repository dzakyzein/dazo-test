<script setup>
import Sidebar from "@/Components/Sidebar.vue";
import HeaderBar from "@/Components/HeaderBar.vue";
</script>

<template>
    <div class="min-h-screen flex bg-gray-50">
        <Sidebar />
        <div class="flex-1 flex flex-col">
            <HeaderBar />
            <main class="p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
