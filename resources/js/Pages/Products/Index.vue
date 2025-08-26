<script setup>
import { reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import AppButton from "@/Components/ui/AppButton.vue";
import AppModal from "@/components/ui/AppModal.vue";
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

// Format price function
const formatPrice = (price) => {
    return new Intl.NumberFormat("id-ID").format(price);
};

// Format date function
const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString("id-ID", {
        day: "2-digit",
        month: "2-digit",
        year: "numeric",
    });
};

// Toggle status function
const toggleStatus = (product) => {
    router.patch(
        route("products.update", { product: product.id }),
        {
            active: !product.active,
        },
        {
            preserveScroll: true,
            onSuccess: () => {
                // Update local state immediately
                product.active = !product.active;
            },
        },
    );
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
                        <th class="p-3 text-left">Nama Produk</th>
                        <th class="p-3 text-left">Stok</th>
                        <th class="p-3 text-left">Kategori</th>
                        <th class="p-3 text-left">Harga Jual</th>
                        <th class="p-3 text-left">Waktu Dibuat</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="p in products.data"
                        :key="p._id"
                        class="border-t hover:bg-gray-50"
                    >
                        <td class="p-3 flex items-center gap-2">
                            <img
                                :src="p.imageUrl || '/img/default.png'"
                                class="w-8 h-8 rounded-sm object-cover"
                            />
                            <div>
                                <div class="font-medium">{{ p.name }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ p.sku }}
                                </div>
                            </div>
                        </td>
                        <td class="p-3">
                            <span
                                class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs"
                            >
                                {{ p.stock }} pcs
                            </span>
                        </td>
                        <td class="p-3">{{ p.category?.name || "-" }}</td>
                        <td class="p-3">
                            <div class="font-semibold">
                                Rp {{ formatPrice(p.price) }}
                            </div>
                            <div
                                v-if="p.special_price"
                                class="text-xs text-green-600"
                            >
                                Spesial: Rp {{ formatPrice(p.special_price) }}
                            </div>
                        </td>
                        <td class="p-3">{{ formatDate(p.created_at) }}</td>
                        <td class="p-3">
                            <label
                                class="inline-flex items-center cursor-pointer"
                            >
                                <input
                                    type="checkbox"
                                    class="sr-only peer"
                                    :checked="p.active"
                                    @change="toggleStatus(p)"
                                />
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
                                ></div>
                                <span
                                    class="ms-3 text-sm font-medium text-gray-900"
                                >
                                    {{ p.active ? "Aktif" : "Nonaktif" }}
                                </span>
                            </label>
                        </td>
                        <td class="p-3">
                            <div class="relative group">
                                <button
                                    class="px-2 py-1 text-gray-500 hover:text-gray-700"
                                >
                                    ⋮
                                </button>
                                <div
                                    class="absolute right-0 top-full mt-1 bg-white border rounded-lg shadow-lg w-32 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10"
                                >
                                    <button
                                        @click="
                                            $inertia.visit(
                                                route('products.edit', p._id),
                                            )
                                        "
                                        class="block w-full px-4 py-2 text-left hover:bg-gray-100 text-sm"
                                    >
                                        ✎ Edit Produk
                                    </button>
                                    <button
                                        @click="confirmDelete(p._id)"
                                        class="block w-full px-4 py-2 text-left hover:bg-gray-100 text-red-600 text-sm"
                                    >
                                        🗑 Hapus Produk
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="p-3 flex justify-end items-center border-t">
                <div class="flex gap-2 items-center">
                    <span class="text-sm text-gray-600">
                        Menampilkan {{ products.from }} - {{ products.to }} dari
                        {{ products.total }} produk
                    </span>
                    <div class="flex gap-1">
                        <button
                            v-if="products.prev_page_url"
                            @click="$inertia.visit(products.prev_page_url)"
                            class="px-3 py-1 border rounded text-sm"
                        >
                            ← Prev
                        </button>
                        <button
                            v-if="products.next_page_url"
                            @click="$inertia.visit(products.next_page_url)"
                            class="px-3 py-1 border rounded text-sm"
                        >
                            Next →
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
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
                <AppButton class="bg-red-600 text-white" @click="doDelete"
                    >Hapus</AppButton
                >
            </div>
        </AppModal>
    </div>
</template>
