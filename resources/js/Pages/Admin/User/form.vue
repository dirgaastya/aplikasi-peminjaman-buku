<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import { ref } from "vue";

const props = defineProps({
  id: String,
  roles: Array,
});

const breadcrumbsItems = ref([
  {
    title: "User",
    to: "staff.index",
  },
  {
    title: props.id ? "Edit" : "Tambah",
    to: "member.create",
  },
]);

const genders = [
  {
    text: "Laki - laki",
    value: "Laki - laki",
  },
  {
    text: "Perempuan",
    value: "Perempuan",
  },
];

const form = useForm({
  role_id: "",
  name: "",
  email: "",
  password: "",
  password_conf: "",
  gender: "",
  address: "",
  no_telp: "",
});

const submit = () => {
  if (props.id) {
    form.put(route("role.update", props.id));
  } else {
    form.post(route(form.role_id === 2 ? "staff.store" : "member.store"), {
      onFinish: () => form.reset(),
    });
  }
};
</script>

<template>
  <Head :title="props.id ? 'Edit User' : 'Tambah User'" />

  <AuthenticatedLayout>
    <template #breadcrumbs>
      <Breadcrumbs :items="breadcrumbsItems" />
    </template>
    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="bg-sky-300 flex items-center justify-between p-3 px-6">
            <h2 class="font-semibold text-xl text-white leading-tight">
              {{ props.id ? "Edit User" : "Tambah User" }}
            </h2>
          </div>
          <div class="p-6">
            <form @submit.prevent="submit" class="grid grid-cols-2 gap-6">
              <VFormSelect
                v-model="form.role_id"
                label="Role"
                name="role_id"
                :items="props.roles"
                item-text="role_name"
                item-value="id"
                class="col-span-2 capitalize"
              >
              </VFormSelect>
              <VInput
                v-model="form.name"
                label="Nama"
                name="name"
                placeholder="Masukan Nama"
              />
              <VInput
                v-model="form.email"
                label="Email"
                name="email"
                placeholder="Masukan Email"
              />
              <VInput
                v-model="form.password"
                label="Password"
                name="password"
                placeholder="Masukan Nama Role"
              />
              <VInput
                v-model="form.password_conf"
                label="Konfirmasi Password"
                name="password_conf"
                placeholder="Masukan Nama Role"
              />
              <VFormSelect
                v-model="form.gender"
                placeholder="Pilih Jenis Kelamin"
                label="Jenis Kelamin"
                name="gender"
                :items="genders"
                class="col-span-2"
                v-if="form.role_id === 3"
              />
              <VInput
                v-model="form.address"
                label="Alamat"
                name="address"
                placeholder="Masukan Nama Role"
                v-if="form.role_id === 3"
              />
              <VInput
                v-model="form.no_telp"
                label="No telepon"
                name="no_telp"
                placeholder="Masukan Nama Role"
                v-if="form.role_id === 3"
              />
              <div class="col-span-2 mt-6 text-right">
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
