<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from '@inertiajs/inertia-vue3';
import {ref} from "vue";

const props = defineProps({
  endpoint: Object,
});

const endpointUrl = ref(props?.endpoint?.data?.url);
const site = ref(props?.endpoint?.data?.site);
</script>

<template>
  <Head><title>Endpoint</title></Head>

  <AuthenticatedLayout>
    <template #left-header>
      <Link :href="route('dashboard', { site })" class="text-gray-500 hover:text-gray-700">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
      </Link>
    </template>
    <template #middle-header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{  endpointUrl }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col">
          <h2 class="font-semibold text-lg text-gray-800 leading-tight">Checks</h2>

          <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 mt-3">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
              <div class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full table-fixed divide-y divide-gray-300">
                  <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="min-w-[12rem] pl-4 py-3.5 px-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                      Checked at
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                      Response code
                    </th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                      Response body
                    </th>
                  </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-200 bg-white">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
