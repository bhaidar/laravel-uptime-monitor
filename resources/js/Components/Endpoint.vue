<script setup>
defineProps({
  endpoint: Object,
});
</script>

<template>
  <tr>
    <td class="whitespace-nowrap pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900 w-64">
      <a href="/" class="text-indigo-600 hover:text-indigo-900">
        {{ endpoint.location }}
      </a>
    </td>
    <td class="whitespace-nowrap px-3 text-sm text-gray-500 w-64">
      {{ endpoint.frequency_label }}
    </td>
    <td class="whitespace-nowrap px-3 text-sm text-gray-500 w-64">
      Last Check
    </td>
    <td class="whitespace-nowrap px-3 text-sm text-gray-500 w-64">
      Status
    </td>
    <td class="whitespace-nowrap px-3 text-sm text-gray-500 w-64">
      x%
    </td>
    <td class="whitespace-nowrap pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-32">
      <button class="text-indigo-600 hover:text-indigo-900">
        Edit
      </button>
    </td>
    <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-16">
      <button class="text-red-600 hover:text-red-900">
        Delete
      </button>
    </td>
  </tr>
</template>