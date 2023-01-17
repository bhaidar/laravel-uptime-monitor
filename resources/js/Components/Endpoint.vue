<script setup>
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Link, useForm, usePage } from "@inertiajs/inertia-vue3";
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
const latestCheck = ref(props?.endpoint?.latest_check);

// watch changes on location or frequencies only
watch(() => endpointForm.isDirty, () => {
  endpointSave();
});

const onDeleteEndpoint = () => {
  if (window.confirm('Are you sure you want to delete this endpoint?')) {
    Inertia.delete(route('endpoints.destroy', { endpoint: props?.endpoint?.id }));
  }
};

const endpointSave = debounce(() => {
  endpointForm.patch(route('endpoints.update', { endpoint: props?.endpoint }), {
    preserveScroll: true,
  });
}, 500);
</script>

<template>
  <tr>
    <td class="whitespace-nowrap pl-4 sm:pl-6 px-3 text-sm font-medium text-gray-900 w-64">
      <template v-if="!editing">
        <Link :href="route('endpoints.index', { endpoint })" class="text-indigo-600 hover:text-indigo-900">
          {{ endpoint.location }}
        </Link>
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
      <time v-if="latestCheck" :datetime="latestCheck?.created_at.date_time" :title="latestCheck?.created_at.date_time">{{ latestCheck?.created_at.human }}</time>
    </td>
    <td class="whitespace-nowrap px-3 text-sm text-gray-500 w-64">
      <template v-if="latestCheck">
        <span
            class="inline-flex items-center rounded-md px-2.5 py-0.5 text-sm font-medium"
            :class="{'bg-green-100 text-green-800': latestCheck?.is_successful, 'bg-red-100 text-red-800': !latestCheck?.is_successful}"
        >
          {{ latestCheck?.response_code}} {{ latestCheck?.status_text}}
        </span>
      </template>
      <template v-else>
        -
      </template>
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