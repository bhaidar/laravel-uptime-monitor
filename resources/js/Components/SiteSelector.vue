<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { useForm } from '@inertiajs/inertia-vue3';
import { VueFinalModal } from 'vue-final-modal';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";


defineProps({
  sites: Object,
});

const showNewSiteModal = ref (false);

const siteForm = useForm({
  domain: null
})

const createSite = () => {
  siteForm.post(route('sites.store'), {
    preserveScroll: true,
    onSuccess: () => {
      siteForm.reset()
      showNewSiteModal.value = false
    }
  })
}
</script>

<template>
  <VDropdown :distance="10">
    <button class="flex items-center space-x-2 text-sm">
      <span class="text-gray-500 hover:text-gray-700">Select a site</span>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3">
        <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z" clip-rule="evenodd" />
      </svg>
    </button>
    <template #popper="{ hide }">
      <ul class="-space-y-1">
        <li v-for="site in sites" :key="site.id">
          <Link :href="route('dashboard', { 'site': site.id})" class="px-4 py-2 block text-sm hover:bg-gray-100 text-gray-500 hover:text-gray-700">{{ site.domain }}</Link>
        </li>
        <li>
          <button @click.prevent="showNewSiteModal = true; hide();" class="block text-left w-full px-4 py-2 hover:bg-gray-100 text-indigo-500 font-bold text-sm">Add a site</button>
        </li>
      </ul>
    </template>
  </VDropdown>

  <teleport to="#modal-area" v-if="showNewSiteModal">
    <VueFinalModal v-model="showNewSiteModal" classes="flex justify-center items-start pt-16 md:pt-24 mx-4"
                   content-class="relative max-h-full rounded bg-white w-full max-w-2xl p-4 md:p-6"
                   overlay-class="bg-gradient-to-r from-gray-800 to-gray-500 opacity-50"
                   :esc-to-close="true">
      <h2 class="font-semibold text-lg text-gray-800 leading-tight">New site</h2>

      <form @submit.prevent="createSite" class="overflow-hidden space-y-4">
        <InputLabel for="domain" value="Domain" class="sr-only" />
        <TextInput id="domain" type="text" class="block w-full h-9 text-sm" placeholder="e.g. https://codecourse.com" v-model="siteForm.domain" :class="{ 'border-red-500': siteForm.errors.domain }" />
        <InputError class="mt-2" :message="siteForm.errors.domain" />

        <PrimaryButton>
          Add
        </PrimaryButton>
      </form>
    </VueFinalModal>
  </teleport>
</template>