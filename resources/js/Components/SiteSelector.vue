<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineProps({
  sites: Object,
});
</script>

<template>
  <VDropdown :distance="10">
    <button class="flex items-center space-x-2 text-sm">
      <span class="text-gray-500 hover:text-gray-700">Select a site</span>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3">
        <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd" />
      </svg>
    </button>
    <template #popper>
      <ul class="-space-y-1">
        <li v-for="site in sites" :key="site.id">
          <Link :href="route('dashboard', { 'site': site.id})" class="px-4 py-2 block text-sm hover:bg-gray-100 text-gray-500 hover:text-gray-700">{{ site.domain }}</Link>
        </li>
        <li>
          <button class="block text-left w-full px-4 py-2 hover:bg-gray-100 text-indigo-500 font-bold text-sm">Add a site</button>
        </li>
      </ul>
    </template>
  </VDropdown>
</template>