<script setup>
import { computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Select from '@/Components/Select.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import Endpoint from "@/Components/Endpoint.vue";
import EmailNotifications from "@/Components/EmailNotifications.vue";

const props = defineProps({
  site: Object,
  sites: Object,
  frequencies: Object,
  endpoints: Object,
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

const endpointsCount = computed(() => props?.endpoints?.data?.length);
</script>

<template>
    <Head>
      <title>Dashboard</title>
    </Head>

    <AuthenticatedLayout>
        <template #left-header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ site.data.domain }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <h2 class="font-semibold text-lg text-gray-800 leading-tight">New Endpoint</h2>

              <form @submit.prevent="storeEndpoint" class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-start p-3 mt-4 space-x-2">
                <div class="grow">
                  <InputLabel for="location" value="Location" class="sr-only" />
                  <TextInput v-model="endpointForm.location" id="location" type="text" placeholder="e.g. /pricing" />
                  <InputError class="mt-2" :message="endpointForm.errors.location" />
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

              <div class="mt-8 flex flex-col">
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                  Currently monitoring ({{ endpointsCount }})
                </h2>
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 mt-3">
                  <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                      <table class="min-w-full table-fixed divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                          <th scope="col" class="min-w-[12rem] pl-4 py-3.5 px-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                            Location
                          </th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Frequency
                          </th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Last check
                          </th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Last status
                          </th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Uptime
                          </th>
                          <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Edit</span>
                          </th>
                          <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Delete</span>
                          </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                          <Endpoint v-for="endpoint in endpoints.data" :key="endpoint.id" :endpoint="endpoint" />
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mt-8 flex flex-col">
                <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                  Notification Emails
                </h2>

                <div class="grid grid-cols-3 gap-12 mt-4">
                  <EmailNotifications :site="site.data" :emails="site.data.notificationEmails" />
                </div>
              </div>

              <div class="mt-8">
                <PrimaryButton class="shrink-0 h-9 bg-red-500 text-white text-sm">Delete site</PrimaryButton>
              </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
