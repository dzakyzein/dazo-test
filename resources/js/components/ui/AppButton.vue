<script setup>
defineProps({
    type: { type: String, default: "button" },
    variant: { type: String, default: "primary" },
    disabled: Boolean,
});
</script>
<template>
    <button
        :type="type"
        :class="[
            'px-4 py-2 rounded-2xl text-sm font-medium shadow',
            variant === 'primary'
                ? 'bg-indigo-600 text-white hover:bg-indigo-700'
                : variant === 'ghost'
                  ? 'bg-transparent hover:bg-gray-100'
                  : 'bg-gray-200',
        ]"
        :disabled="disabled"
    >
        <slot />
    </button>
</template>
