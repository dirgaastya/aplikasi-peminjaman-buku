<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import { ref } from "vue";

const props = defineProps({
  id: String,
  rak: Array,
  buku: Array,
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

const form = useForm({
  title: props.buku?.title || "",
  qty: props.buku?.qty || "",
  penerbit: props.buku?.penerbit || "",
  pengarang: props.buku?.pengarang || "",
  tahun: props.buku?.year || "",
  rak: props.buku?.rak_id || "",
});

const submit = () => {
  if (props.id) {
    form.put(route("buku.update", props.id));
  } else {
    form.post(route("buku.store"), {
      onFinish: () => form.reset(),
    });
  }
};
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
            <form @submit.prevent="submit" class="grid grid-cols-2 gap-6">
              <VInput
                v-model="form.title"
                label="Judul"
                name="title"
                placeholder="Masukan Judul"
              />
              <VInput
                v-model="form.qty"
                type="number"
                name="qty"
                label="Jumlah Buku"
                placeholder="Masukan Jumlah Buku"
              />
              <VInput
                v-model="form.penerbit"
                label="Penerbit"
                name="penerbit"
                placeholder="Masukan Nama Penerbit"
              />
              <VInput
                v-model="form.pengarang"
                label="Pengarang"
                name="pengarang"
                placeholder="Masukan Nama Pengarang"
              />
              <VInput
                v-model="form.tahun"
                name="tahun"
                label="Tahun"
                placeholder="Masukan Tahun"
              />
              <VFormSelect
                v-model="form.rak"
                placeholder="Pilih Rak"
                label="Rak"
                name="rak"
                :items="props.rak"
                item-text="lokasi"
                item-value="kode_rak"
              />
              <div class="col-span-2 place-self-end">
                <VBtn
                  type="submit"
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
