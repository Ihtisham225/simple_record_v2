<!--
  This example requires Tailwind CSS v2.0+ 
  
  This example requires some changes to your config:
  
  ```
  // tailwind.config.js
  module.exports = {
    // ...
    theme: {
      extend: {
        gridTemplateRows: {
          '[auto,auto,1fr]': 'auto auto 1fr',
        },
      },
    },
    plugins: [
      // ...
      require('@tailwindcss/aspect-ratio'),
    ],
  }
  ```
-->
<template>
  <div class="bg-white">
    <div class="pt-6">
      <!-- Image gallery -->
      <div class="mt-6 max-w-2xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-3 lg:gap-x-8 gap-y-4">
        <div v-for="image in product.images" class="aspect-w-3 aspect-h-4 rounded-lg overflow-hidden lg:block">
          <a href="#" @click.prevent="fullScreen(`${image}`)"><img :src="'/products/'+storeName+'/'+image" :alt="image.alt"  class="w-full h-full object-center object-cover" /></a>
        </div>
      </div>


      <!-- Product info -->
      <div class="max-w-2xl mx-auto pt-10 pb-16 px-4 sm:px-6 lg:max-w-7xl lg:pt-16 lg:pb-24 lg:px-8 lg:grid lg:grid-cols-1 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8">
      <hr class="mb-3">
        <div class="lg:col-span-2 lg:pr-8">
          <h1 class="text-2xl font-extrabold tracking-tight text-gray-900 sm:text-3xl">
            {{ product.name }}
          </h1>
        </div>

        <div class="py-10 lg:pt-6 lg:pb-16 lg:col-start-1 lg:col-span-2 lg:pr-8">
          <!-- Details -->
          <div>
            <h2 class="sr-only">Product information</h2>
            <p class="text-3xl text-gray-900">Rs.{{ product.sell_price }}</p>
          </div>

          <div class="mt-10">
            <h3 class="sr-only">Description</h3>

            <div class="space-y-6">
              <p class="text-base font-bold text-gray-900">Brand: {{ brand }}</p>
              <p class="text-base font-bold text-gray-900">Model: {{ product.model }}</p>
              <p class="text-base font-bold text-gray-900">Quantity: {{ product.quantity }}</p>
              <p class="text-base font-bold text-gray-900">Status: {{ product.quantity > 0 ? "Available" : "Not Available"}}</p>
            </div>
          </div>

          <div class="mt-10">
            <h2 class="text-2xl font-bold text-gray-900">Details</h2>

            <div class="mt-4 space-y-6">
              <p class="text-base font-bold text-gray-600">{{ product.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <div class="mt-2">
                      <img :src="'/products/'+storeName+'/'+image" :alt="image.alt"  class="w-full h-full object-center object-cover" />
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </TransitionChild>
        </div>
        </Dialog>
    </TransitionRoot>
</template>

<script>
import { ref } from 'vue'
import { StarIcon } from '@heroicons/vue/solid'
import { Inertia } from '@inertiajs/inertia'
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'

//import components for delete confirmation overlay
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ExclamationIcon } from '@heroicons/vue/outline'


  
export default {

  props: {
    product: Object,
    brand: Object,
    storeName: Object,
  },

  data() {
    //open the delete confirmation overlay is set to false initially
    const open = ref(false)

    return {
      //set the overlay to open i.e false
      open,
    }
  },
  
  components: {
    RadioGroup,
    RadioGroupLabel,
    RadioGroupOption,
    StarIcon,
    Inertia,

    //call delete confirmation components
    Dialog,
    DialogOverlay,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
    ExclamationIcon,
  },

  methods: {
    fullScreen(image){
      this.image = image;
      this.open = true;
    },
  },

  setup() {
  },
}
</script>