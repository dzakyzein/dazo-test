<script setup>
const props = defineProps({ open: Boolean, title: String });
const emit = defineEmits(["close"]);
</script>

<template>
    <div
        v-if="open"
        class="fixed inset-0 z-50 flex items-center justify-center"
    >
        <div class="absolute inset-0 bg-black/40" @click="emit('close')" />
        <div class="relative bg-white rounded-2xl p-6 w-full max-w-lg">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold">{{ title }}</h3>
                <button @click="emit('close')">✕</button>
            </div>
            <slot />
        </div>
    </div>
</template>
