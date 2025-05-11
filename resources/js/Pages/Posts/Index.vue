<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Posts
        </h2>
        <Link
          v-if="$page.props.auth.user.is_admin"
          :href="route('posts.create')"
          class="text-blue-500 hover:text-blue-700"
        >
          Novo Post
        </Link>
      </template>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div v-for="post in posts" :key="post.id" class="p-6 border-b">
              <h3 class="font-bold">{{ post.title }}</h3>
              <p class="text-gray-600">{{ post.content }}</p>
              <p class="text-sm text-gray-500">Por: {{ post.user.name }}</p>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>

  <script setup lang="ts">
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
  import { Link } from '@inertiajs/vue3'

  defineProps({
    posts: Array
  })
  </script>
