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
});

const submit = () => form.post(route("products.store"));
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
                <!-- PERBAIKAN: Gunakan @click="submit" atau type="submit" pada tag form -->
                <AppButton class="bg-blue-600 text-white" @click="submit"
                    >Tambah Produk</AppButton
                >
            </div>
        </div>

        <form
            @submit.prevent="submit"
            class="bg-white rounded-xl border p-6 space-y-6"
        >
            <section>
                <h3 class="font-medium mb-3">Informasi Produk</h3>
                <AppInput label="Nama Produk *" v-model="form.name" />
                <label class="block mt-3">
                    <span>Kategori Produk *</span>
                    <select
                        v-model="form.category_id"
                        class="w-full border rounded-xl px-3 py-2"
                    >
                        <option value="">-- pilih kategori --</option>
                        <option
                            v-for="c in categories"
                            :key="c._id"
                            :value="c._id"
                        >
                            {{ c.name }}
                        </option>
                    </select>
                </label>
                <AppInput label="SKU *" v-model="form.sku" class="mt-3" />
                <label class="mt-3 flex items-center gap-2">
                    <input type="checkbox" v-model="form.active" />
                    <span>Status Produk</span>
                </label>
            </section>

            <section>
                <h3 class="font-medium mb-3">Harga, Variasi, & Stok</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <AppInput
                        label="Stok *"
                        type="number"
                        v-model="form.stock"
                    />
                    <AppInput
                        label="Harga Modal *"
                        type="number"
                        v-model="form.cost"
                    />
                    <AppInput
                        label="Harga Jual *"
                        type="number"
                        v-model="form.price"
                    />
                    <AppInput
                        label="Harga Spesial"
                        type="number"
                        v-model="form.special_price"
                    />
                </div>
            </section>
        </form>
    </div>
</template>
