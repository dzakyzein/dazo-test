<script setup>
import { ref, defineEmits, defineProps } from "vue";
import { Link } from "@inertiajs/vue3";
import {
    ChevronDownIcon,
    ChevronRightIcon,
    ChevronLeftIcon,
    ChevronDoubleLeftIcon,
    ChevronDoubleRightIcon,
} from "@heroicons/vue/24/outline";
import { BuildingStorefrontIcon } from "@heroicons/vue/24/solid";

const productMenuOpen = ref(true);

const props = defineProps({
    isOpen: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(["toggle-sidebar"]);

const toggleSidebar = () => {
    emit("toggle-sidebar");
};
</script>

<template>
    <aside
        class="flex flex-col h-screen px-4 py-8 overflow-y-auto overflow-x-hidden bg-gray-900 border-r rtl:border-r-0 rtl:border-l dark:bg-gray-800 dark:border-gray-700 relative transition-all duration-300 ease-in-out"
        :class="{
            'w-64': isOpen,
            'w-0 overflow-hidden': !isOpen,
        }"
    >
        <!-- HEADER -->
        <div v-if="isOpen" class="flex items-center justify-between mb-6">
            <a href="#" class="text-2xl font-bold text-white">Dazo.id</a>
            <!-- Tombol toggle saat sidebar terbuka -->
            <button
                @click="toggleSidebar"
                class="text-white hover:text-gray-300 focus:outline-none"
            >
                <ChevronLeftIcon class="w-5 h-5" />
            </button>
        </div>

        <!-- NAV -->
        <div v-if="isOpen" class="flex flex-col justify-between flex-1 mt-6">
            <nav class="flex-1 -mx-3 space-y-2">
                <div>
                    <button
                        @click="productMenuOpen = !productMenuOpen"
                        class="flex items-center justify-between w-full px-3 py-2 text-gray-200 transition-colors duration-300 transform rounded-lg hover:bg-gray-700 dark:hover:bg-gray-700"
                    >
                        <span class="flex items-center">
                            <BuildingStorefrontIcon class="w-5 h-5" />
                            <span class="mx-2 text-sm font-medium">Produk</span>
                        </span>
                        <ChevronDownIcon
                            v-if="productMenuOpen"
                            class="w-4 h-4"
                        />
                        <ChevronRightIcon v-else class="w-4 h-4" />
                    </button>

                    <!-- Submenu -->
                    <div v-show="productMenuOpen" class="mt-2 space-y-2">
                        <Link
                            :href="route('products.index')"
                            class="flex items-center w-full px-6 py-2 text-gray-300 transition-colors duration-300 transform rounded-lg hover:bg-gray-700 hover:text-gray-100"
                        >
                            <span class="mx-2 text-sm font-medium"
                                >Daftar Produk</span
                            >
                        </Link>
                    </div>
                </div>
            </nav>
        </div>
    </aside>

    <!-- Tombol toggle saat sidebar tertutup -->
    <button
        v-if="!isOpen"
        @click="toggleSidebar"
        class="absolute left-0 top-8 bg-gray-900 text-white p-2 rounded-r-lg shadow-lg z-50"
    >
        <ChevronRightIcon class="w-5 h-5" />
    </button>
</template>
