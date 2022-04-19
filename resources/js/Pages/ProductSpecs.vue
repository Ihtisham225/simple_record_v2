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
          <img :src="'/products/'+image" :alt="image.alt" class="w-full h-full object-center object-cover" />
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
            <p class="text-3xl text-gray-900">Rs.{{ product.price }}</p>
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
</template>

<script>
import { ref } from 'vue'
import { StarIcon } from '@heroicons/vue/solid'
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from '@headlessui/vue'

  
export default {
  components: {
    RadioGroup,
    RadioGroupLabel,
    RadioGroupOption,
    StarIcon,
  },

  props: {
    product: Object,
    brand: Object,
  },

  setup() {
  },
}
</script>