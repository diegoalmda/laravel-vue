<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Criar Post
        </h2>
      </template>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div v-if="$page.props.auth.user.is_admin" class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form @submit.prevent="submit" class="p-6">
              <div class="mb-4">
                <label for="title" class="block text-gray-700">Título</label>
                <input
                  id="title"
                  v-model="form.title"
                  type="text"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                  required
                >
                <InputError :message="form.errors.title" />
              </div>

              <div class="mb-4">
                <label for="content" class="block text-gray-700">Conteúdo</label>
                <textarea
                  id="content"
                  v-model="form.content"
                  rows="4"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                  required
                ></textarea>
                <InputError :message="form.errors.content" />
              </div>

              <PrimaryButton type="submit" :disabled="form.processing">
                Criar Post
              </PrimaryButton>
            </form>
          </div>
          <div v-else class="p-6 bg-white shadow-sm rounded-lg text-red-500">
            Você não tem permissão para criar posts.
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>

  <script setup lang="ts">
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
  import InputError from '@/Components/InputError.vue'
  import PrimaryButton from '@/Components/PrimaryButton.vue'
  import { useForm } from '@inertiajs/vue3'

  const form = useForm({
    title: '',
    content: ''
  })

  const submit = () => {
    form.post(route('posts.store'), {
      preserveScroll: true,
      onSuccess: () => form.reset(),
    })
  }
  </script>
