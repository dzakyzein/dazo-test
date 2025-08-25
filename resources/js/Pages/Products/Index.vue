<script setup>
import { reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import AppButton from "@/Components/ui/AppButton.vue";
import AppModal from "@/Components/ui/AppModal.vue";
import { router } from "@inertiajs/vue3";

defineOptions({ layout: AppLayout });
const props = defineProps({ products: Object });

const state = reactive({ open: false, toDelete: null });
const confirmDelete = (id) => {
    state.open = true;
    state.toDelete = id;
};
const doDelete = () => {
    router.delete(route("products.destroy", state.toDelete), {
        onSuccess: () => (state.open = false),
    });
};
</script>

<template>
    <div>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Daftar Produk</h2>
            <AppButton
                @click="$inertia.visit(route('products.create'))"
                class="bg-blue-600 text-white"
                >+ Tambah Produk</AppButton
            >
        </div>

        <div class="bg-white rounded-xl border overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-500">
                    <tr>
                        <th class="p-3">Nama Produk</th>
                        <th class="p-3">Varian</th>
                        <th class="p-3">Tipe Produk</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Harga Jual</th>
                        <th class="p-3">Waktu Dibuat</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="p in products.data"
                        :key="p._id"
                        class="border-t"
                    >
                        <td class="p-3 flex items-center gap-2">
                            <img
                                :src="p.image ?? '/img/default.png'"
                                class="w-8 h-8 rounded-sm"
                            />
                            <span
                                >{{ p.name }} <br /><span
                                    class="text-xs text-gray-500"
                                    >{{ p.sku }}</span
                                ></span
                            >
                        </td>
                        <td class="p-3">{{ p.variant ?? "-" }}</td>
                        <td class="p-3">{{ p.type ?? "-" }}</td>
                        <td class="p-3">{{ p.category?.name }}</td>
                        <td class="p-3">
                            Rp {{ p.price_min }} - Rp {{ p.price_max }}
                        </td>
                        <td class="p-3">{{ p.created_at }}</td>
                        <td class="p-3">
                            <input
                                type="checkbox"
                                class="toggle"
                                v-model="p.active"
                            />
                        </td>
                        <td class="p-3">
                            <div class="relative">
                                <button class="px-2">⋮</button>
                                <div
                                    class="absolute right-0 mt-2 bg-white border rounded-sm shadow-sm w-32"
                                >
                                    <button
                                        @click="
                                            $inertia.visit(
                                                route('products.edit', p._id),
                                            )
                                        "
                                        class="block w-full px-3 py-2 text-left hover:bg-gray-100"
                                    >
                                        ✎ Edit Produk
                                    </button>
                                    <button
                                        @click="confirmDelete(p._id)"
                                        class="block w-full px-3 py-2 text-left hover:bg-gray-100 text-red-600"
                                    >
                                        🗑 Hapus Produk
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="p-3 flex justify-end">
                <!-- Pagination -->
            </div>
        </div>

        <!-- Modal -->
        <AppModal
            :open="state.open"
            title="Yakin ingin menghapus produk?"
            @close="state.open = false"
        >
            <p class="mb-4 text-sm text-gray-600">
                Setelah dihapus, produk ini tidak bisa dikembalikan. Pastikan
                kamu yakin sebelum melanjutkan.
            </p>
            <div class="flex justify-end gap-2">
                <AppButton variant="ghost" @click="state.open = false"
                    >Batal</AppButton
                >
                <AppButton class="bg-blue-600 text-white" @click="doDelete"
                    >Hapus</AppButton
                >
            </div>
        </AppModal>
    </div>
</template>
