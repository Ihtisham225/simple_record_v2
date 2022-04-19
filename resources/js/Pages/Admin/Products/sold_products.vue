<template>
    <Layout>
        <!--Search-->
        <div class="pt-2 ml-3 mx-auto text-gray-600">

            <!-- <button class="bg-transparent ml-3 py-2 px-4 border border-blue-500 rounded">
                Total Products: {{ totalproducts }}
                | Total Products Price: Rs. {{ totalbudget }} 
            </button> -->

            <input class="border-2 border-gray-300 bg-white ml-7 h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
            type="search" v-model="searchQuery" placeholder="Search">
        </div>
        <!--End Search-->

        <div class="flex flex-col m-10">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Product Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Model
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Quanity
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sold Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sold To (Customer)
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Selling Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="r of resultQuery" :key="r.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ r.name }}</div>
                            <!-- <div class="text-sm text-gray-500">{{ person.department }}</div> -->
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ r.model }}</div>
                            <!-- <div class="text-sm text-gray-500">{{ person.department }}</div> -->
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"> {{ r.sold_quantity }} </div>
                            <!-- <div class="text-sm text-gray-500">{{ person.department }}</div> -->
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">Rs. {{ r.sold_at }} </div>
                            <!-- <div class="text-sm text-gray-500">{{ person.department }}</div> -->
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ r.customer }}</div>
                            <!-- <div class="text-sm text-gray-500">{{ person.department }}</div> -->
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"> {{ moment(r.updated_at).format('DD-MMM-YYYY') }} </div>
                            <!-- <div class="text-sm text-gray-500">{{ person.department }}</div> -->
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                            <!-- product innvoice -->
                            <button v-if="r.sold_at != 0 && r.customer.id != 0" @click.prevent="invoiceProduct(`${r.id}`)" title="invoice" class="text-indigo-600 hover:text-indigo-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                            </svg>
                            </button>

                            <!-- delete product -->
                            <button title="delete" @click.prevent="deleteProduct(`${r.id}`)" class="text-indigo-600 hover:text-danger-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </Layout>

    <!-- This is alert box for deleting recored -->
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto" @close="open = false">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
            <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
            </TransitionChild>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <ExclamationIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">
                        Delete Record
                    </DialogTitle>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                        Are you sure you want to delete this record? This record will be permanently removed. This action cannot be undone.
                        </p>
                    </div>
                    </div>
                </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button @click.prevent="deleteItem(id)" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" @click="open = false">
                    Delete
                </button>
                <button @click.prevent="cancelItem()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="open = false" ref="cancelButtonRef">
                    Cancel
                </button>
                </div>
            </div>
            </TransitionChild>
        </div>
        </Dialog>
    </TransitionRoot>
    <Paginate :links="products.links"/>
</template>
<script>

import Layout from '../AdminLayout'
import Paginate from '../Partials/Pagination'
import { Inertia } from '@inertiajs/inertia'

//import this moment library for showing date in correct format
import moment from 'moment'

//import components for delete confirmation overlay
import { ref } from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ExclamationIcon } from '@heroicons/vue/outline'

export default {

    props: {

        //products array passed from the controller
        products: Object,

        //profit array passed from the controller
        profit: Object,
    },

    data() {

        //open the delete confirmation overlay is set to false initially
        const open = ref(false)
        return {

            //set the overlay to open i.e false
            open,

            //id of the product which is selected for deletion
            id: null,

            //search a specific product
            searchQuery: null,
        }
    },
    computed: {

        //logic of search query goes here
        resultQuery() {
        if (this.searchQuery) {
            return this.products.data.filter(item => {
            return this.searchQuery
                .toLowerCase()
                .split(" ")
                .every(v => item.name.toLowerCase().includes(v));
            });
        } else {
            return this.products.data;
            }
        }
    },


    components: {
        Layout,
        Paginate,

        //call delete confirmation components
        Dialog,
        DialogOverlay,
        DialogTitle,
        TransitionChild,
        TransitionRoot,
        ExclamationIcon,
    },

    methods: {

        //this function call the delete confirmation overlay
        deleteProduct(id){
            this.id = id;
            this.open = true;
        },

        //this function deletes the recored
        deleteItem(){
            Inertia.delete(`/delete-product/${this.id}`);
            this.open = false;
        },        

        //this fucntion return already sold product
        returnProduct(id){
            Inertia.delete(`/return-product/${id}`, {
                onBefore: () => confirm('Are you sure you want to return this product?'),
            })
        },

        //this function cancel the delete confirmation overlay
        cancelItem(){
            this.open = false;
        },

        //this fucntion invoice product
        invoiceProduct(id){
            Inertia.get(`/invoice-product/${id}`)
        },


        //call the moment function for date time format
        moment,
    },
}
</script>
<style>
    
</style>