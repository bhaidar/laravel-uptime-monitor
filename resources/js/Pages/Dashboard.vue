<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import SiteSelector from "@/Components/SiteSelector.vue";

defineProps({
  site: Object,
  sites: Object,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
          <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            <div>
              <SiteSelector :sites="sites.data" />
            </div>
          </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">{{ site }}</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
