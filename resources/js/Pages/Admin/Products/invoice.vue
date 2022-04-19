<template>
<Layout>
   <div id="invoice" class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="w-3/5 bg-white shadow-lg">
                <div class="flex justify-between p-4">
                    <div>
                        <h1 class="text-3xl italic font-extrabold tracking-widest text-indigo-500">{{ store.name }}</h1>
                    </div>
                    <div class="p-2">
                        <ul class="flex">
                            <li class="flex flex-col p-2 border-l-2 border-indigo-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm">
                                    {{ store.address }},
                                    {{ store.phone }},
                                    {{ store.email }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flex justify-between p-4">
                    <div>
                        <h6 class="font-bold">Order Date : <span class="text-sm font-medium">{{ moment(product.updated_at).format('DD-MMM-YYYY') }}</span></h6>
                    </div>
                    <div class="w-40">
                        <address class="text-sm">
                            <span class="font-bold"> Billed To : </span>
                            Name: {{ product.customer }}
                        </address>
                    </div>
                </div>


                <div class="flex justify-between p-4">
                    <div>
                        <h6 class="font-bold">Brand : <span class="text-sm font-medium">{{ product.brand }}</span></h6>
                        <h6 class="font-bold">Model : <span class="text-sm font-medium">{{ product.model }}</span></h6>
                        <h6 class="font-bold">Description : <span class="text-sm font-medium">{{ product.description }}</span></h6>
                        <h6 class="font-bold">Quanity : <span class="text-sm font-medium">{{ product.sold_quantity }}</span></h6>
                        <h6 class="font-bold">Unit Price : <span class="text-sm font-medium">{{ product.sold_at }}</span></h6>
                    </div>
                    <div class="w-40">
                        <address class="text-sm">
                            <span class="font-bold"> Total Price: Rs. {{ product.sold_quantity * product.sold_at }}</span>
                        </address>
                    </div>
                </div>
                       
                <div class="flex justify-between p-4">
                    <div>
                        <h3 class="text-xl">Terms And Condition :</h3>
                        <ul class="text-xs list-disc list-inside">
                            <li>All accounts are to be paid within 7 days from receipt of invoice.</li>
                            <li>To be paid by cheque or credit card or direct payment online.</li>
                            <li>If account is not paid within 7 days the credits details supplied.</li>
                        </ul>
                    </div>
                    <div class="p-4">
                        <h3>Signature</h3>
                        <div class="text-4xl italic text-indigo-500">AAA</div>
                    </div>
                </div>
                <div class="w-full h-0.5 bg-indigo-500"></div>

                <div class="p-4">
                    <div class="flex items-center justify-center">
                        Thank you very much for doing business with us.
                    </div>
                    <div class="flex items-end justify-end space-x-3">
                        <button @click.prevent="printInvoice('invoice')" class="px-4 py-2 text-sm text-green-600 bg-green-100">Print</button>
                    </div>
                </div>

            </div>
        </div>
</Layout>
</template>

<script>

import Layout from '../AdminLayout'
import { PaperClipIcon } from '@heroicons/vue/solid'

//import this moment library for showing date in correct format
import moment from 'moment'

export default {
    props: {
        product: Object,
        store: Object,
    },

    components: {
        PaperClipIcon,
        Layout,
    },

    methods: {

      printInvoice(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
      },

      //call the moment function for date time format
      moment,
    }
}
</script>