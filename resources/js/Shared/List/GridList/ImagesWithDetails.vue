<template>
<span class="text-indigo-500 font-semibold text-lg">Select image to delete it</span>
  <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
    <li v-for="file in files" :key="file.source" class="relative">
      <div class="group block w-full aspect-w-10 aspect-h-7 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden">
        <img :src="file.source" alt="" class="object-cover pointer-events-none group-hover:opacity-75" />
        <Link :href="`/images/${file.image_id}/delete`" class="absolute inset-0 focus:outline-none">
          <span class="sr-only">View details for {{ file.title }}</span>
        </Link>
      </div>
      <p class="mt-2 block text-sm font-medium text-gray-900 truncate pointer-events-none">{{ file.title }} - {{file.image_id}}</p>
      <p class="block text-sm font-medium text-gray-500 pointer-events-none">{{ convertSize(parseInt(file.size)) }}</p>
    </li>
  </ul>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import convertSize from "convert-size";

defineProps({
     files: Object
})
</script>