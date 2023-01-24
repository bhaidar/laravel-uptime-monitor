<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

const props = defineProps({
  site: Object,
  emails: Object,
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

const onEmailDelete = (email) => {
  Inertia.delete(route('site.notifications.destroy', { site: props?.site, email }));
}
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

    <div class="mt-6" v-if="emails?.length">
      <ul class="space-y-2">
        <li class="flex items-center justify-between" v-for="email in emails" :key="email">
          <span class="text-sm">{{  email }}</span>

          <button @click.prevent="onEmailDelete(email)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
              <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
            </svg>
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>