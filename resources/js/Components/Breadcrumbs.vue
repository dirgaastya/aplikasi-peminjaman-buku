<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import {
  VBreadcrumbs,
  VBreadcrumbsItem,
  VBreadcrumbsDivider,
} from "@morpheme/breadcrumbs";
defineProps({
  items: [],
});
</script>

<template>
  <VBreadcrumbs>
    <VBreadcrumbsItem to="/">
      <Link :href="route('dashboard')">
        <VIcon name="ic:round-home" class="w-10 h-10 p-1" />
      </Link>
    </VBreadcrumbsItem>
    <VBreadcrumbsDivider />
    <VBreadcrumbsItem
      v-if="items.length > 0"
      v-for="(item, index) in items"
      :key="item.title"
    >
      <Link :href="route(item.to)">
        {{ item.title }}
      </Link>
      <VBreadcrumbsDivider v-if="items.length - 1 !== index" class="ms-3" />
    </VBreadcrumbsItem>
  </VBreadcrumbs>
</template>

<style>
li.breadcrumbs-item {
  list-style: none;
  padding-left: 0;
  padding-right: 0;
}
</style>
