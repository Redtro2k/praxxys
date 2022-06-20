<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Images
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                         <form @submit.prevent="submit" class="space-y-8 divide-y divide-gray-200" enctype="multipart/form-data">
                              <div class="space-y-8 divide-y divide-gray-200">
                                   <div>
                                        <div>
                                             <h3 class="text-lg leading-6 font-medium text-gray-900">Profile</h3>
                                             <p class="mt-1 text-sm text-gray-500">This information will be displayed publicly so be careful what you share.</p>
                                        </div>

                                        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                             <div class="sm:col-span-3">
                                                       <label for="title-picture" class="block text-sm font-medium text-gray-700"> Title Picture </label>
                                                  <div class="mt-1">
                                                       <input type="text" v-model="form.name" autocomplete="given-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                                  </div>
                                                  <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
                                             </div>

                                             <div class="sm:col-span-6">
                                                  <label for="cover-photo" class="block text-sm font-medium text-gray-700"> Add Photos </label>
                                                  <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                       <div class="space-y-1 text-center">
                                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                                 <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                            <div class="flex text-sm text-gray-600">
                                                                 <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                                      <input type="file" @input="form.image = $event.target.files[0]"/>
                                                                 </label>
                                                            </div>
                                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                                       </div>
                                                  </div>
                                                  <div v-if="form.errors.image" v-text="form.errors.image" class="text-red-500 text-xs mt-1"></div>

                                             </div>
                                             <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                                  {{ form.progress.percentage }}%
                                             </progress>
                                        </div>
                                   </div>
                              </div>
                              <div class="pt-5">
                                   <div class="flex justify-end">
                                        <button type="submit" :disabled="form.processing" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                   </div>
                              </div>
                         </form>
                    </div>
                </div>
            </div>
        </div>

     <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                         <ImagesWithDetails :files="images"/>
                    </div>
               </div>
          </div>
     </div>

    </BreezeAuthenticatedLayout>
</template>
<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { defineAsyncComponent } from 'vue'


const props = defineProps({
     current_id: Number,
     images: Object
})

const ImagesWithDetails = defineAsyncComponent({
    loader: () => import('@/Shared/List/GridList/ImagesWithDetails.vue'),
    loadingComponent: 'loading ...',
    delay: 200,
    errorComponent: 'Error',
    timeout: 3000
})

const form = useForm({
     name: '',
     image: null
})
let submit = () => {
     form.post('/images/'+ props.current_id , {
          preserveScroll: true,
     })
}
</script>
