<template>
    <Head title="Products" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="w-full sm:w-64">
                            <div class="mt-1 flex rounded-md shadow-sm pb-7">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm"> Find </span>
                                <input type="text" v-model="search" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300" placeholder="NVIDIA" />
                            </div>
                        </div>
                        <SimpleTable
                            title="List of products"
                            description=" A list of all the products in our database including title, description and other."
                            :lists="products"
                        />
                        <Pagination 
                            :links="products.links"
                            :from="products.from"
                            :to="products.to"
                            :result="products.total"
                            :responsive-next="products.next_page_url"
                            :responsive-previous="products.first_page_url"
                        />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/inertia-vue3';
import { defineAsyncComponent, ref, watch } from 'vue'
import {debounce} from "lodash";

const props = defineProps({
     products: Object,
     filter: Object
})

const SimpleTable = defineAsyncComponent({
    loader: () => import('@/Shared/List/table/SimpleTable.vue'),
    loadingComponent: 'Loading',
    delay: 200,
    errorComponent: 'error',
    timeout: 300
})
const Pagination = defineAsyncComponent({
    loader: () => import('@/Shared/Navigation/Paginate/Paginate.vue'),
    loadingComponent: 'Loading',
    delay: 200,
    errorComponent: 'error',
    timeout: 300
})

let search = ref(props.filter.search)
watch(search, debounce(function(value){
    Inertia.get('/product', {search: value}, {preserveState: true, replace: true});
    }, 300));
</script>
 
