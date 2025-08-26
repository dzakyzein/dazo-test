<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppInput from "@/Components/ui/AppInput.vue";
import AppButton from "@/Components/ui/AppButton.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineOptions({ layout: AppLayout });
const props = defineProps({ categories: Array });

const form = useForm({
    name: "",
    category_id: "",
    sku: "",
    active: true,
    stock: 0,
    cost: 0,
    price: 0,
    special_price: null,
    imageUrl: "",
});

const submit = () => {
    console.log("Form data sebelum submit:", form.data());
    form.post(route("products.store"));
};
</script>

<template>
    <div>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Tambah Produk</h2>
            <div class="flex gap-2">
                <AppButton
                    variant="ghost"
                    @click="$inertia.visit(route('products.index'))"
                    >Kembali</AppButton
                >
                <AppButton
                    class="bg-blue-600 text-white"
                    @click="submit"
                    :disabled="form.processing"
                >
                    {{ form.processing ? "Menyimpan..." : "Tambah Produk" }}
                </AppButton>
            </div>
        </div>

        <form
            @submit.prevent="submit"
            class="bg-white rounded-xl border p-6 space-y-6"
        >
            <!-- Error Message -->
            <div
                v-if="Object.keys(form.errors).length"
                class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg"
            >
                <p class="font-semibold">Terjadi kesalahan:</p>
                <ul class="list-disc list-inside mt-1">
                    <li v-for="error in form.errors" :key="error">
                        {{ error }}
                    </li>
                </ul>
            </div>

            <section>
                <h3 class="font-medium mb-3">Informasi Produk</h3>
                <AppInput
                    label="Nama Produk *"
                    v-model="form.name"
                    :error="form.errors.name"
                />

                <label class="block mt-3">
                    <span class="text-sm font-medium text-gray-700"
                        >Kategori Produk *</span
                    >
                    <select
                        v-model="form.category_id"
                        class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-blue-500 focus:border-blue-500"
                        :class="{ 'border-red-500': form.errors.category_id }"
                    >
                        <option value="">-- pilih kategori --</option>
                        <option
                            v-for="c in categories"
                            :key="c.id"
                            :value="c.id"
                        >
                            {{ c.name }}
                        </option>
                    </select>
                    <p
                        v-if="form.errors.category_id"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.category_id }}
                    </p>
                </label>

                <AppInput
                    label="SKU *"
                    v-model="form.sku"
                    :error="form.errors.sku"
                    class="mt-3"
                />

                <AppInput
                    label="Gambar Produk (URL)"
                    v-model="form.imageUrl"
                    :error="form.errors.imageUrl"
                    class="mt-3"
                />

                <label class="mt-3 flex items-center gap-2">
                    <input
                        type="checkbox"
                        v-model="form.active"
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    />
                    <span class="text-sm text-gray-700">Aktifkan Produk</span>
                </label>
            </section>

            <section>
                <h3 class="font-medium mb-3">Harga & Stok</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <AppInput
                        label="Stok *"
                        type="number"
                        v-model="form.stock"
                        :error="form.errors.stock"
                    />
                    <AppInput
                        label="Harga Modal *"
                        type="number"
                        v-model="form.cost"
                        :error="form.errors.cost"
                    />
                    <AppInput
                        label="Harga Jual *"
                        type="number"
                        v-model="form.price"
                        :error="form.errors.price"
                    />
                    <AppInput
                        label="Harga Spesial"
                        type="number"
                        v-model="form.special_price"
                        :error="form.errors.special_price"
                    />
                </div>
            </section>
        </form>
    </div>
</template>
