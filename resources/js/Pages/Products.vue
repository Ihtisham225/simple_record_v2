<template>

  <div class="bg-gray-100">
    <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
      <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">{{ store.name }} | {{ owner.name }} | {{ store.address }}</h2>
      <p><a target="_blank" :href="'whatsapp://send?phone='+store.phone+'&text=Hi, I came from Secure POS'"><img class = "inline" src="/logo/whatsapp.svg" /></a>+{{ store.phone }}</p>

      <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8 ">
        <h2 v-if="products == 0" class="text-2xl font-extrabold tracking-tight text-gray-900">This store is empty</h2>
        <div v-for="product in products" :key="product.id" class="group relative w-90 p-6 border-2 bg-white border-solid rounded-lg hover:shadow-2xl transition ease-in-out delay-150 duration-300">
          <div class="w-full min-h-80 border-b-2 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
            <img :src="'/products/'+product.images[0]" alt="" class="w-full h-full object-center lg:w-full lg:h-full" />
          </div>
          <div class="mt-4 flex justify-between p-4">
            <div>
              <h3 class="text-sm text-gray-700">
                <a :href="'/product-specs/'+product.id">
                  <span aria-hidden="true" class="absolute inset-0" />
                  {{ product.name }}
                </a>
              </h3>
              <p class="mt-1 text-sm text-gray-500">Model: {{ product.model }}</p>
              <p class="mt-1 text-sm text-gray-500">Quantity: {{ product.quantity }}</p>
              <p class="mt-1 text-sm text-gray-500">Status: {{ product.quantity > 0 ? "Available" : "Out of stock" }}</p>
            </div>
            <p class="text-sm font-medium text-gray-900">Rs. {{ product.sell_price }}</p>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    products: Object,
    store: Object,
    owner: Object,
  }
}
</script>