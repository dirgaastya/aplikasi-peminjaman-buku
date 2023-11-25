<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import VDataTable from "@morpheme/table";
import { ref } from "vue";

const search = ref("");
const headers = ref([
  {
    value: "index",
    text: "ID",
  },
  {
    value: "title",
    text: "Judul Buku",
  },
  {
    value: "penerbit",
    text: "Penerbit",
  },
  {
    value: "pengarang",
    text: "Pengarang",
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
const props = defineProps({
  books: Array,
});

console.log(props.books);
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <!-- <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        List Buku
      </h2>
    </template> -->

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div
            class="bg-emerald-300 flex items-center justify-between p-3 px-6"
          >
            <h2 class="font-semibold text-xl text-white leading-tight">
              List Buku
            </h2>
            <Link href="/">
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
              striped
              :items="books"
              :headers="headers"
              v-model:search="search"
            >
              <template #item.action>
                <div class="flex items-center gap-x-3">
                  <VIcon name="tabler:trash" class="text-red-500" />
                  <VIcon name="raphael:edit" class="text-cyan-500" />
                </div>
              </template>
            </VDataTable>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
