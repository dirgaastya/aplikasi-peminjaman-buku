<script setup lang="ts">
import NavLink from "@/Components/NavLink.vue";

interface NavItems {
  name: string;
  to: string;
  icon: string;
}
const items: NavItems[] = [
  {
    name: "Dashboard",
    to: "dashboard",
    icon: "ri:home-2-line",
  },
  {
    name: "Book",
    to: "buku.index",
    icon: "solar:book-broken",
  },
];
</script>

<template>
  <VList class="space-y-1">
    <VListItem
      v-for="(item, index) in items"
      :key="index"
      :prepend-icon="item.icon"
      hide-append
      :to="item.to"
      default-class="text-md"
    >
      <NavLink :href="route(item.to)" :active="route().current(item.to)">
        {{ item.name }}
      </NavLink>
    </VListItem>
  </VList>
</template>
