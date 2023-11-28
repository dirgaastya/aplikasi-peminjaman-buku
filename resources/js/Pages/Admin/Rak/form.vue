<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import { ref } from "vue";

const props = defineProps({
  kode_rak: String,
  rak: Array,
});

const breadcrumbsItems = ref([
  {
    title: "Rak",
    to: "rak.index",
  },
  {
    title: props.kode_rak ? "Edit" : "Tambah",
    to: "rak.create",
  },
]);

const form = useForm({
  kode_rak: props.rak?.kode_rak || "",
  lokasi: props.rak?.lokasi || "",
});

const submit = () => {
  if (props.kode_rak) {
    form.put(route("rak.update", props.kode_rak));
  } else {
    form.post(route("rak.store"), {
      onFinish: () => form.reset(),
    });
  }
};
</script>

<template>
  <Head :title="props.kode_rak ? 'Edit Rak' : 'Tambah Rak'" />

  <AuthenticatedLayout>
    <template #breadcrumbs>
      <Breadcrumbs :items="breadcrumbsItems" />
    </template>
    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="bg-sky-300 flex items-center justify-between p-3 px-6">
            <h2 class="font-semibold text-xl text-white leading-tight">
              {{ props.kode_rak ? "Edit Rak" : "Tambah Rak" }}
            </h2>
          </div>
          <div class="p-6">
            <form @submit.prevent="submit" class="grid grid-cols-2 gap-6">
              <VInput
                v-model="form.kode_rak"
                label="Kode Rak"
                name="title"
                placeholder="Masukan Kode Rak"
              />
              <VInput
                v-model="form.lokasi"
                label="Lokasi"
                name="lokasi"
                placeholder="Masukan Lokasi"
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
