<script setup>

import {ref} from "vue";

const props = defineProps({
  check: Object,
});

const createdAt = ref(props?.check?.created_at?.date_time);
const status = ref(props?.check?.status_text);
const isSuccessful = ref(props?.check?.is_successful);
const responseCode = ref(props?.check?.response_code);
</script>

<template>
  <tr>
    <td class="whitespace-nowrap py-4 pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900">
      {{  createdAt }}
    </td>
    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
      <span
          class="inline-flex items-center rounded-md px-2.5 py-0.5 text-sm font-medium"
          :class="{'bg-green-100 text-green-800': isSuccessful, 'bg-red-100 text-red-800': !isSuccessful}"
      >
          {{ responseCode }} {{ status }}
        </span>
    </td>
    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
      View
    </td>
  </tr>
</template>
