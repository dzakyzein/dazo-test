<script setup>
import Sidebar from "@/Components/Sidebar.vue";
import HeaderBar from "@/Components/HeaderBar.vue";
import { ref } from "vue";

defineProps({
    title: String,
});

const sidebarOpen = ref(true);

const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};
</script>

<template>
    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar Container -->
        <div
            class="transition-all duration-300 ease-in-out"
            :class="{
                'w-64': sidebarOpen,
                'w-0': !sidebarOpen,
            }"
        >
            <Sidebar @toggle-sidebar="toggleSidebar" :is-open="sidebarOpen" />
        </div>

        <!-- Main Content -->
        <div
            class="flex flex-col flex-1 overflow-x-hidden overflow-y-auto transition-all duration-300"
            :class="{
                'ml-0': sidebarOpen,
                'ml-10': !sidebarOpen,
            }"
        >
            <HeaderBar :title="title" />

            <main class="flex-1 p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
