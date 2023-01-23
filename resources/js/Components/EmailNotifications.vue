<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
  site: Object,
});

const emailForm = useForm({
  email: '',
});

const storeEmailNotification = () => {
  emailForm.post(route('site.notifications.store', { site: props.site }), {
    preserveScroll: true,
    onSuccess: () => {
      emailForm.reset();
    },
  });
};
</script>

<template>
  <div class="bg-white overflow-hidden shadow-sm rounded-lg p-4">
    <h2 class="font-semibold text-base text-gray-800 leading-tight">Email</h2>

    <form @submit.prevent="storeEmailNotification" class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-start p-3 mt-4 space-x-2">
      <div class="grow">
        <InputLabel for="email" value="Email" class="sr-only" />
        <TextInput v-model="emailForm.email" id="email" type="text" />
        <InputError class="mt-2" :message="emailForm.errors.email" />
      </div>

      <PrimaryButton class="shrink-0 h-9">
        Add
      </PrimaryButton>
    </form>
  </div>
</template>