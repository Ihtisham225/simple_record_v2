<template>
    <Layout>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <header class="bg-white shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <h1 class="text-3xl font-bold text-gray-900">
                                Dashboard
                            </h1>
                            <h3>Edit This Store <a :href="/edit-store/+id" class="text-blue-700" >Here</a></h3>
                            </div>
                        </header>
                        <main>
                            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                                <!-- Filters starts-->
                                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                                    <div class="mx-auto mt-10 grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-10 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:mx-0 lg:max-w-none lg:grid-cols-5">
                                        <a :href="/dashboard/+id" :class="badge == 'all' ? 'rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'rounded-md bg-gray-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600'">All</a>
                                        <a :href="/filter-today/+id" :class="badge == 'today' ? 'rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'rounded-md bg-gray-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600'">Today</a>
                                        <a :href="/filter-week/+id" :class="badge == 'week' ? 'rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'rounded-md bg-gray-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600'">This Week</a>
                                        <a :href="/filter-month/+id" :class="badge == 'month' ? 'rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'rounded-md bg-gray-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600'">This Month</a>
                                        <a :href="/filter-year/+id" :class="badge == 'year' ? 'rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'rounded-md bg-gray-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600'">This Year</a>
                                    </div>
                                </div>
                                <!-- Filters ends-->
                            <!-- Replace with your content -->
                            <section class="py-8 bg-blueGray-50 overflow-hidden">
                            <div class="container px-4 mx-auto">
                                <div class="flex flex-wrap -mx-4 xl:-mx-7">
                                <div class="w-full md:w-1/2 xxl:w-1/4 px-4 xl:px-7 mb-8 xl:mb-15">
                                    <div class="h-full pt-10 px-5 pb-6 text-center bg-red-100 rounded-3xl hover:shadow-lg">
                                    <a href="/list">
                                    <h3 class="mb-6 text-sm text-darkBlueGray-300 font-heading font-medium">Products In Store</h3>
                                    <div class="flex items-center justify-center mb-6">
                                        <span class="inline-block mr-2 text-6xl font-heading font-medium">{{ totalproducts }}</span>
                                        <div class="px-3 text-center bg-green-200 bg-opacity-70 rounded-full">
                                        </div>
                                    </div>
                                    </a>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 xxl:w-1/4 px-4 xl:px-7 mb-8 mb-8 xl:mb-15">
                                    <div class="h-full pt-10 px-5 pb-6 text-center bg-green-100 rounded-3xl hover:shadow-lg">
                                    <h3 class="mb-6 text-sm text-darkBlueGray-300 font-heading font-medium">Products Sold</h3>
                                    <a href="/sold-products">
                                    <div class="flex items-center justify-center mb-6">
                                        <span class="inline-block mr-2 text-6xl font-heading font-medium">{{ totalSold }}</span>
                                        <div class="px-3 text-center bg-green-200 bg-opacity-70 rounded-full">
                                        </div>
                                    </div>
                                    </a>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 xxl:w-1/4 px-4 xl:px-7 mb-8 mb-8 xl:mb-15">
                                    <div class="h-full pt-10 px-5 pb-6 text-center bg-blue-100 rounded-3xl hover:shadow-lg">
                                    <a href="/sold-products">
                                    <h3 class="mb-6 text-sm text-darkBlueGray-300 font-heading font-medium">Total Profit</h3>
                                    <div class="flex items-center justify-center mb-6">
                                        <span class="inline-block mr-2 text-6xl font-heading font-medium">Rs.{{ totalProfit }}</span>
                                        <div class="px-3 text-center bg-red-200 bg-opacity-70 rounded-full">
                                        </div>
                                    </div>
                                    </a>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 xxl:w-1/4 px-4 xl:px-7 mb-8 xl:mb-15">
                                    <div class="h-full pt-10 px-5 pb-6 text-center bg-yellow-100 rounded-3xl hover:shadow-lg">
                                    <a href="/list-expense">
                                    <h3 class="mb-6 text-sm text-darkBlueGray-300 font-heading font-medium">Total Expenses</h3>
                                    <div class="flex items-center justify-center mb-6">
                                        <span class="inline-block mr-2 text-6xl font-heading font-medium">Rs. {{ totalExpenses }}</span>
                                        <div class="px-3 text-center bg-green-200 bg-opacity-70 rounded-full">
                                        </div>
                                    </div>
                                    </a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </section>
                            <!-- /End replace -->
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script>

import Layout from './AdminLayout'
import { Inertia } from '@inertiajs/inertia'

//import components for delete confirmation overlay
import { ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ExclamationIcon } from '@heroicons/vue/outline'

export default {

    props: {

        //products array passed from the controller
        title: Object,
        badge: Object,
        totalbudget: Object,
        totalproducts: Object,
        totalProfit: Object,
        totalcustomers: Object,
        totalExpenses: Object,
        totalSold: Object,
        id: Object,
    },
    components: {
        Layout,
    },
}
</script>
<style>
    
</style>