<script setup>
import {ref} from "vue";
import { VueFinalModal } from 'vue-final-modal';

import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
  check: Object,
});

const createdAt = ref(props?.check?.created_at?.date_time);
const status = ref(props?.check?.status_text);
const isSuccessful = ref(props?.check?.is_successful);
const responseCode = ref(props?.check?.response_code);
const responseBody = ref(props?.check?.response_body);
const showBodyModal = ref (false);
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
      <template v-if="responseBody">
        <SecondaryButton @click.prevent="showBodyModal = true;">
          View
        </SecondaryButton>
      </template>
      <template v-else>-</template>
    </td>
  </tr>
  <teleport to="#modal-area" v-if="showBodyModal">
    <VueFinalModal v-model="showBodyModal" classes="flex justify-center items-start pt-16 md:pt-24 mx-4"
                   content-class="relative max-h-full rounded bg-white w-full max-w-2xl p-4 md:p-6"
                   overlay-class="bg-gradient-to-r from-gray-800 to-gray-500 opacity-50"
                   :esc-to-close="true">
      <textarea :value="responseBody" readonly class="border-gray-300 rounded-md w-full bg-gray-50" rows="10" />
    </VueFinalModal>
  </teleport>
</template>
