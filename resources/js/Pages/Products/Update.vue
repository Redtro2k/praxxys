<template>
    <Head title="Create" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit
            </h2>
        </template>
         <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit" class="space-y-8 divide-y divide-gray-200">
                            <div class="space-y-8 divide-y divide-gray-200">
                                <div>
                                    <div>
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Product</h3>
                                        <p class="mt-1 text-sm text-gray-500">This information will be displayed publicly or Private so be careful what you share.</p>
                                    </div>

                                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                        <div class="sm:col-span-4">
                                            <label for="pname" class="block text-sm font-medium text-gray-700"> Product Name </label>
                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm"> Product/ </span>
                                                    <input type="text" v-model="form.name" class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300" />
                                            </div>
                                            <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>

                                        </div>
                                    <div class="sm:col-span-4">
                                        <label for="pname" class="block text-sm font-medium text-gray-700"> Product Category </label>
                                            <v-select v-model="form.category" :options="categories" label="cname" :reduce="cname => cname.cid"/>
                                            <div v-if="form.errors.category" v-text="form.errors.category" class="text-red-500 text-xs mt-1"></div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="about" class="block text-sm font-medium text-gray-700"> Description </label>
                                            <div class="mt-1">
                                                <QuillEditor v-model:content="form.description" contentType="html"  placeholder="content here" toolbar="minimal" theme="snow" />
                                                <div v-if="form.errors.description" v-text="form.errors.description" class="text-red-500 text-xs mt-1"></div>
                                            </div>
                                        <p class="mt-2 text-sm text-gray-500">Write a few sentences about description.</p>
                                    </div>
                                    <div class="sm:col-span-6">
                                        <Datepicker  v-model="form.created" placeholder="Start Typing ..." :is24="false" textInput/>
                                        <div v-if="form.errors.created" v-text="form.errors.description"></div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>
                            <div class="pt-5">
                                <div class="flex justify-end">
                                   <Link :href="`/product/${props.products[0].pid}/delete`" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Delete</Link>

                                    <button :disabled="form.processing" type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Next Step</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
    </BreezeAuthenticatedLayout>
</template>
<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    categories: Object,
    products: Object
})
let form = useForm({
    name: props.products[0].pname,
    category: props.products[0].pcategory,
    description: props.products[0].pdescription,
    created: props.products[0].created
})

let submit = () => {
    form.post(`/product/update/${props.products[0].pid}`, {
        preserveScroll: true,
    })
}
</script>


