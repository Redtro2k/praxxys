<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <div>
    <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">Pinned Projects</h2>
    <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
      <li v-for="project in projects" :key="project.name" class="col-span-1 flex shadow-sm rounded-md">
        <div :class="[project.bgColor, 'flex-shrink-0 flex items-center justify-center w-16 text-white text-sm font-medium rounded-l-md']">
          {{ project.initials }}
        </div>
        <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
          <div class="flex-1 px-4 py-2 text-sm truncate">
            <Link :href="project.href" class="text-gray-900 font-medium hover:text-gray-600">{{ project.name }}</Link>
            <p class="text-gray-500">{{ project.total }} Total</p>
          </div>
          <div class="flex-shrink-0 pr-2">
            <button type="button" class="w-8 h-8 bg-white inline-flex items-center justify-center text-gray-400 rounded-full bg-transparent hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              <span class="sr-only">Open options</span>
              <DotsVerticalIcon class="w-5 h-5" aria-hidden="true" />
            </button>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { DotsVerticalIcon } from '@heroicons/vue/solid'
import { Link } from '@inertiajs/inertia-vue3'
defineProps({
     projects: Object
})
</script>