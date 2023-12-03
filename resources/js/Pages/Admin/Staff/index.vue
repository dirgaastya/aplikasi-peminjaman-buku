<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import VDataTable from "@morpheme/table";
import { ref } from "vue";
import moment from "moment";

const form = useForm({});
const search = ref("");
const headers = ref([
  {
    value: "index",
    text: "ID",
  },
  {
    value: "name",
    text: "Nama",
  },
  {
    value: "email",
    text: "Email",
  },
  {
    value: "created_at",
    text: "create_at",
  },
  {
    value: "updated_at",
    text: "Update_at",
  },
  {
    value: "action",
    text: "Action",
  },
]);

const breadcrumbsItems = ref([
  {
    title: "Staff",
    to: "staff.index",
  },
]);

defineProps({
  staffs: Array,
});

const handleDelete = (id) => {
  form.delete(route("staff.destroy", id));
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #breadcrumbs>
      <Breadcrumbs :items="breadcrumbsItems" />
    </template>

    <div class="py-6">
      <div class="sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="bg-sky-300 flex items-center justify-between p-3 px-6">
            <h2 class="font-semibold text-xl text-white leading-tight">
              List Staff
            </h2>
            <Link :href="route('staff.create')">
              <VIcon name="ic:baseline-plus" class="text-white" />
            </Link>
          </div>
          <div class="p-6">
            <VInput
              v-model="search"
              placeholder="Search..."
              wrapper-class="mb-4"
              prepend-icon="ri:search-line"
            />
            <VDataTable
              dense
              striped
              :items="staffs"
              :headers="headers"
              v-model:search="search"
            >
              <template #item.created_at="{item}">
                {{ moment(item.created_at).format("L h:mm:ss") }}
              </template>
              <template #item.updated_at="{item}">
                {{ moment(item.updated_at).format("L h:mm:ss") }}
              </template>
              <template #item.action="{item}">
                <div class="flex items-center gap-x-3">
                  <VBtn icon fab text @click="handleDelete(item.id)">
                    <VIcon name="tabler:trash" class="text-red-500" />
                  </VBtn>
                  <Link :href="route('staff.edit', item.id)">
                    <VIcon name="raphael:edit" class="text-cyan-500" />
                  </Link>
                </div>
              </template>
            </VDataTable>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
