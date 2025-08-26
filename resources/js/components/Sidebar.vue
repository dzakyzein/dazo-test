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
        class="flex flex-col h-full px-4 py-8 overflow-y-auto bg-gray-900 border-r rtl:border-r-0 rtl:border-l dark:bg-gray-800 dark:border-gray-700 relative w-full"
        :class="{
            'w-64': isOpen,
            'w-0 overflow-hidden': !isOpen,
        }"
    >
        <div v-if="isOpen" class="flex items-center justify-between mb-6">
            <a href="#" class="mx-auto text-2xl font-bold text-white"
                >Dazo.id</a
            >
        </div>

        <!-- Toggle Button -->
        <button
            @click="toggleSidebar"
            class="absolute -right-3 top-8 bg-gray-700 text-white p-1 rounded-full shadow-lg focus:outline-none z-50"
        >
            <ChevronLeftIcon v-if="isOpen" class="w-5 h-5" />
            <ChevronRightIcon v-else class="w-5 h-5" />
        </button>

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
                            class="flex items-center w-full px-6 py-2 text-gray-300 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-700 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-100"
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
</template>
