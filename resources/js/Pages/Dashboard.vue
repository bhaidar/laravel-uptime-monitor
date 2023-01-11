<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import SiteSelector from "@/Components/SiteSelector.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Select from '@/Components/Select.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  site: Object,
  sites: Object,
  frequencies: Object,
});

const endpointForm = useForm({
  location: null,
  frequency: props.frequencies.data[0].frequency,
});

const storeEndpoint = () => {
  endpointForm.post(route('site.endpoints.store', { site: props.site.data }), {
    preserveScroll: true,
    onSuccess: () => {
      endpointForm.reset();
    },
  });
};
</script>

<template>
    <Head>
      <title>Dashboard</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
          <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ site.data.domain }}</h2>
            <div>
              <SiteSelector :sites="sites.data" />
            </div>
          </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <h2 class="font-semibold text-lg text-gray-800 leading-tight">New Endpoint</h2>

              <form @submit.prevent="storeEndpoint" class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-start p-3 mt-4 space-x-2">
                <div class="grow">
                  <InputLabel for="location" value="Location" class="sr-only" />
                  <TextInput v-model="endpointForm.location" id="location" type="text" class="block w-full h-9 text-sm" placeholder="e.g. /pricing" />
                </div>

                <div>
                  <Select v-model="endpointForm.frequency">
                    <option v-for="frequency in frequencies.data" :key="frequency.frequency" :value="frequency.frequency">
                      {{ frequency.label }}
                    </option>
                  </Select>
                </div>

                <PrimaryButton class="shrink-0 h-9">
                  Add
                </PrimaryButton>
              </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
