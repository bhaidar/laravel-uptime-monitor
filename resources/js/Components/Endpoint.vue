<script setup>
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import debounce from 'lodash/debounce';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Select from "@/Components/Select.vue";

const props = defineProps({
  endpoint: Object,
});

const endpointForm = useForm({
  location: props?.endpoint?.location,
  frequency: props?.endpoint?.frequency,
});

const editing = ref(false);
const frequencies = ref(usePage()?.props?.value?.frequencies?.data);

// watch any changes on the form and save
watch(endpointForm, () => {
  endpointSave();
});

const onDeleteEndpoint = () => {
  if (window.confirm('Are you sure you want to delete this endpoint?')) {
    Inertia.delete(route('endpoints.destroy', { endpoint: props?.endpoint?.id }));
  }
};

const endpointSave = debounce(() => {
  console.log('send api request');
}, 500);
</script>

<template>
  <tr>
    <td class="whitespace-nowrap pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900 w-64">
      <template v-if="!editing">
        <a href="/" class="text-indigo-600 hover:text-indigo-900">
          {{ endpoint.location }}
        </a>
      </template>
      <template v-else>
          <InputLabel for="location" value="Location" class="sr-only" />
          <TextInput v-model="endpointForm.location" id="location" type="text" placeholder="e.g. /pricing" />
          <InputError class="mt-2" :message="endpointForm.errors.location" />
      </template>
    </td>
    <td class="whitespace-nowrap px-3 text-sm text-gray-500 w-64">
      <template v-if="!editing">
        {{ endpoint.frequency_label }}
      </template>
      <template v-else>
        <Select v-model="endpointForm.frequency">
          <option v-for="frequency in frequencies" :key="frequency.frequency" :value="frequency.frequency">
            {{ frequency.label }}
          </option>
        </Select>
      </template>
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
      <SecondaryButton @click.prevent="editing = !editing">
        {{ !editing ? 'Edit' : 'Done' }}
      </SecondaryButton>
    </td>
    <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 w-16">
      <SecondaryButton type="button" @click.prevent="onDeleteEndpoint" class="text-red-600 hover:text-red-900">
        Delete
      </SecondaryButton>
    </td>
  </tr>
</template>