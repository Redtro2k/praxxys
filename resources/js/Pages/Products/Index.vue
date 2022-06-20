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
                        <SimpleTable
                            title="List of products"
                            description=" A list of all the products in our database including title, description and other."
                            :lists="products"
                        />
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { defineAsyncComponent } from 'vue'


const SimpleTable = defineAsyncComponent({
    loader: () => import('@/Shared/List/table/SimpleTable.vue'),
    loadingComponent: 'Loading',
    delay: 200,
    errorComponent: 'error',
    timeout: 300
})

defineProps({
     products: Object
})
</script>
 
