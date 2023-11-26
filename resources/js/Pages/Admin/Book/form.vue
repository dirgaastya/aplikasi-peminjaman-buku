<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import { ref } from "vue";

const props = defineProps({
  id: String,
});

const breadcrumbsItems = ref([
  {
    title: "Buku",
    to: "buku.index",
  },
  {
    title: props.id ? "Edit" : "Tambah",
    to: "buku.create",
  },
]);
</script>

<template>
  <Head :title="props.id ? 'Edit Buku' : 'Tambah Buku'" />

  <AuthenticatedLayout>
    <template #breadcrumbs>
      <Breadcrumbs :items="breadcrumbsItems" />
    </template>
    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="bg-sky-300 flex items-center justify-between p-3 px-6">
            <h2 class="font-semibold text-xl text-white leading-tight">
              {{ props.id ? "Edit Buku" : "Tambah Buku" }}
            </h2>
          </div>
          <div class="p-6">
            <form class="grid grid-cols-2 gap-6">
              <VInput label="Judul" />
              <VInput type="number" label="Jumlah Buku" />
              <VInput label="Penerbit" />
              <VInput label="Pengarang" />
              <VInput label="Tahun" />
              <VInput label="Rak" />
              <div class="col-span-2 place-self-end">
                <VBtn
                  color="primary"
                  prefix-icon="material-symbols:save-outline"
                >
                  Save
                </VBtn>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
