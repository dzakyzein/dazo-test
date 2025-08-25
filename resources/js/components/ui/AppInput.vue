<script setup>
const props = defineProps({
    modelValue: [String, Number],
    label: String,
    type: { type: String, default: "text" },
    error: String,
    placeholder: String,
});
const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <label class="block space-y-1">
        <span class="text-sm text-gray-700" v-if="label">{{ label }}</span>
        <input
            :type="type"
            :placeholder="placeholder"
            class="w-full border rounded-xl px-3 py-2 focus:outline-hidden focus:ring-3"
            :value="modelValue"
            @input="(e) => emit('update:modelValue', e.target.value)"
        />
        <p v-if="error" class="text-xs text-red-600">{{ error }}</p>
    </label>
</template>
