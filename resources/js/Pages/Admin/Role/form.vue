<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import { ref } from "vue";

const props = defineProps({
  id: String,
  role: Array,
});

const breadcrumbsItems = ref([
  {
    title: "Role",
    to: "role.index",
  },
  {
    title: props.id ? "Edit" : "Tambah",
    to: "role.create",
  },
]);

const form = useForm({
  role_name: props.role?.role_name || "",
});

const submit = () => {
  if (props.id) {
    form.put(route("role.update", props.id));
  } else {
    form.post(route("role.store"), {
      onFinish: () => form.reset(),
    });
  }
};
</script>

<template>
  <Head :title="props.id ? 'Edit Role' : 'Tambah Role'" />

  <AuthenticatedLayout>
    <template #breadcrumbs>
      <Breadcrumbs :items="breadcrumbsItems" />
    </template>
    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="bg-sky-300 flex items-center justify-between p-3 px-6">
            <h2 class="font-semibold text-xl text-white leading-tight">
              {{ props.id ? "Edit Role" : "Tambah Role" }}
            </h2>
          </div>
          <div class="p-6">
            <form @submit.prevent="submit" class="gap-6">
              <VInput
                v-model="form.role_name"
                label="Nama Role"
                name="role_name"
                placeholder="Masukan Nama Role"
              />
              <div class="mt-6 text-right">
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
