<script setup lang="ts">
import { breakpointsTailwind, useBreakpoints } from "@vueuse/core";
import { ref, watchEffect } from "vue";
import NavLink from "@/Components/NavLink.vue";
import { NavDrawer } from "@morpheme/nav-drawer";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const breakpoints = useBreakpoints(breakpointsTailwind);
const isMobile = breakpoints.smaller("sm"); // only smaller than lg
const isAsideOpen = ref(true);
const isMini = ref(false);

const menus = ref([
  {
    title: "Home",
    to: "dashboard",
    prependIcon: "ri:home-2-line",
  },
  {
    title: "User Management",
    prependIcon: "clarity:users-solid",
    items: [
      {
        title: "Role",
        to: "role.index",
        prependIcon: "fa6-solid:user-lock",
      },
      {
        title: "Staff",
        to: "staff.index",
        prependIcon: "uim:user-md",
      },
      {
        title: "Member",
        to: "member.index",
        prependIcon: "fa:user",
      },
    ],
  },
  {
    title: "Master Data",
    prependIcon: "carbon:data-base",
    items: [
      {
        title: "Buku",
        to: "buku.index",
        prependIcon: "ri:book-line",
      },
      {
        title: "Rak",
        to: "rak.index",
        prependIcon: "game-icons:bookshelf",
      },
    ],
  },
]);

watchEffect(() => {
  isAsideOpen.value = !isMobile.value;
});
</script>

<template>
  <VAppShell fluid class="bg-gray-50">
    <!-- header -->

    <template #navigation>
      <VAppBar sticky size="md" class="mb-5">
        <div class="flex w-full justify-between items-center">
          <VBtn text icon rounded>
            <VIcon
              class="w-5 h-5"
              name="ri:menu-line"
              @click="isMini = !isMini"
            />
          </VBtn>
          <div class="hidden sm:flex sm:items-center sm:ms-6">
            <div class="ms-3 relative">
              <Dropdown align="right" width="48">
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <button
                      type="button"
                      class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                    >
                      <VAvatar color="primary">{{
                        $page.props.auth.user.name[0]
                      }}</VAvatar>
                    </button>
                  </span>
                </template>

                <template #content>
                  <DropdownLink :href="route('profile.edit')">
                    Profile
                  </DropdownLink>
                  <DropdownLink
                    :href="route('logout')"
                    method="post"
                    as="button"
                  >
                    Log Out
                  </DropdownLink>
                </template>
              </Dropdown>
            </div>
          </div>
        </div>
      </VAppBar>
      <div class="px-6 lg:px-8" v-if="$slots.breadcrumbs">
        <slot name="breadcrumbs" />
      </div>
    </template>
    <!-- aside -->
    <template #aside>
      <NavDrawer
        v-model:mini="isMini"
        v-model="isAsideOpen"
        :fixed="isMobile"
        :overlay="isMobile"
        :close-on-overlay-click="isMobile"
        :class="{ 'z-20 !w-10/12 sidebar': isMobile }"
        style="min-height: 100%;"
        bordered
      >
        <div
          :class="`flex justify-between items-center ${
            isMini ? 'p-1' : 'ps-6 pe-3 py-3'
          }`"
        >
          <VText font-weight="semibold" variant="display-xs">Logo</VText>
        </div>
        <VList>
          <template v-for="menu in menus" :key="menu.text">
            <VListCollapse v-if="menu.items">
              <template #activator="{ isOpen, toggle }">
                <VListItem
                  v-bind="menu"
                  :class="isMini ? 'justify-center' : ''"
                  :hide-text="isMini"
                  :hide-append="isMini"
                  append-icon="ri:arrow-down-s-line"
                  :append-icon-class="isOpen ? 'rotate-180' : ''"
                  @click="toggle"
                >
                  {{ menu.title }}
                </VListItem>
              </template>
              <VList>
                <VListItem
                  v-for="child in menu.items"
                  :key="child.title"
                  v-bind="child"
                  :class="isMini ? 'justify-center' : ''"
                  :hide-text="isMini"
                  :hide-append="isMini"
                >
                  <NavLink
                    :href="route(child.to)"
                    :active="route().current(child.to)"
                  >
                    {{ child.title }}
                  </NavLink>
                </VListItem>
              </VList>
            </VListCollapse>
            <VListItem
              v-else
              v-bind="menu"
              :class="isMini ? 'justify-center' : ''"
              :hide-text="isMini"
              :hide-append="isMini"
            >
              {{ menu.title }}
            </VListItem>
          </template>
        </VList>
      </NavDrawer>
    </template>

    <!-- footer -->
    <template #content.after>
      <VText variant="sm" color="gray.500" class="m-4">
        Copyright &copy; 2023 &middot; All rights reserved.
      </VText>
    </template>

    <!-- content -->
    <slot />
  </VAppShell>
</template>

<style lang="scss">
.nav-drawer-morning-glory {
  --nav-drawer-bg-color: var(--color-morning-glory-100);
}
.dark {
  .nav-drawer-morning-glory {
    --nav-drawer-bg-color: var(--color-gray-true-800);
    --nav-drawer-border-color: var(--color-gray-true-700);
  }
}
aside .nav-drawer {
  height: 100% !important;
}
</style>
