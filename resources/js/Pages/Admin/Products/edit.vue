<template>
  <Layout>
    <div class="mt-10 m-14 sm:mt-10">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Edit Product</h3>
          <p class="mt-1 text-sm text-gray-600">
            Carefully Complete All The Fields
          </p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent="submit">

            <!-- hidden input field for product id -->
            <input type="hidden" v-model="form.p_id" />


          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="p_name" class="block text-sm font-medium text-gray-700">Product name</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.p_name">{{ errors.p_name }}</div>
                  <input type="text" autocomplete="off" v-model="form.p_name" id="p_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="brand" class="block text-sm font-medium text-gray-700">Product Brand</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.brand">{{ errors.brand }}</div>
                  <input type="text" autocomplete="off" v-model="form.brand_name" id="brand" list="brand_list" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
                  <datalist id="brand_list" >
                    <option v-for="brand in brands" :value="brand.name"></option>
                  </datalist>
                  <!-- <select id="brand" autocomplete="off" v-model="form.brand_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
                  </select> -->
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="model" class="block text-sm font-medium text-gray-700">Product Model</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.p_model">{{ errors.p_model }}</div>
                  <input type="text" v-model="form.p_model" id="model" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="toogleA" class="flex items-center cursor-pointer"> 
                    <!-- toggle -->
                    <div class="relative">
                      <!-- input -->
                      <input v-on:click="isHidden = !isHidden" id="toogleA" type="checkbox" class="sr-only" />
                      <!-- line -->
                      <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                      <!-- dot -->
                      <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition"></div>
                    </div>
                    <!-- label -->
                    <div class="ml-3 text-gray-700 font-medium">WalkIn Seller</div>
                  </label>
                </div>

                <div v-if="isHidden" class="col-span-6 sm:col-span-3">
                  <label for="p_name" class="block text-sm font-medium text-gray-700">Seller Name</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.s_name">{{ errors.s_name }}</div>
                  <input type="text" autocomplete="off" v-model="form.s_name" id="s_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div v-if="isHidden" class="col-span-6 sm:col-span-3">
                  <label for="p_name" class="block text-sm font-medium text-gray-700">Seller Phone#</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.s_phone">{{ errors.s_phone }}</div>
                  <input type="text" autocomplete="off" v-model="form.s_phone" id="s_phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div v-if="!isHidden" class="col-span-6 sm:col-span-3">
                  <label for="seller_id" class="block text-sm font-medium text-gray-700">Product Purchsed From</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.seller_id">{{ errors.seller_id }}</div>
                  <select id="seller_id" autocomplete="off" v-model="form.seller_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option v-for="seller in sellers" :value="seller.id">{{ seller.name }}</option>
                  </select>
                </div>


                <div class="col-span-6 sm:col-span-3">
                  <label for="price" class="block text-sm font-medium text-gray-700">Product Price</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.price">{{ errors.price }}</div>
                  <input type="number" v-model="form.price" id="price" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>


                <div class="col-span-6 sm:col-span-3">
                  <label for="price" class="block text-sm font-medium text-gray-700">Product Quantity</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.quantity">{{ errors.quantity }}</div>
                  <input type="number" v-model="form.quantity" id="price" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="sell_price" class="block text-sm font-medium text-gray-700">Product Selling Price</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.sell_price">{{ errors.sell_price }}</div>
                  <input type="number" autocomplete="off" v-model="form.sell_price" id="sell_price" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="description" class="block text-sm font-medium text-gray-700">
                    Product Description
                  </label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.description">{{ errors.description }}</div>
                  <div class="mt-1">
                    <textarea id="description" name="description" v-model="form.description" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" placeholder="Some Extra Information about this product" />
                  </div>
                  <p class="mt-2 text-sm text-gray-500">
                    Brief description about your product.
                  </p>
                </div>

                  <div class="col-span-6 sm:col-span-3">
                  <label class="block text-sm font-medium text-gray-700">
                    Product photos
                  </label>
                  <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                    <div class="space-y-1 text-center">
                      <div class="flex text-sm text-gray-600">
                        <label for="p-image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                          <!-- <span>Upload a file</span> -->
                          <input id="p_image" type="file" multiple @change="uploadImage"/>
                        </label>
                      </div>
                      <p class="text-xs text-gray-500">
                        PNG, JPG, GIF up to 10MB
                      </p>
                    </div>
                  </div>
                </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Update
              </button>
              
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  </Layout>
</template>

<script>
  
  import Layout from '../AdminLayout'
  import { useForm } from '@inertiajs/inertia-vue3'
  import heic2any from "heic2any";
  export default {
    props: {
        errors: Object,
        product: Object,
        brands: Object,
        sellers: Object,
        customers: Object,
        store_name: Object,
    },

    data() {
      return { 
        isHidden: false, 
        form: this.$inertia.form({
            p_id: this.product.id,
            p_name: this.product.name,
            brand_name: this.product.brand_name,
            p_model: this.product.model,
            price: this.product.price,
            sell_price: this.product.sell_price,
            quantity: this.product.quantity,
            sold_at: this.product.sold_at,
            seller_id: this.product.seller_id,
            s_name: this.product.seller_name,
            s_phone: this.product.seller_phone,
            customer_id: this.product.customer_id,
            status: this.product.status,
            p_images: [],
            description: this.product.description,
        }),
        }
    },

    methods: {

      uploadImage(e) {
        var selectedFiles = e.target.files;
        for (let i = 0; i < selectedFiles.length; i++) {
            // fetching the heic image
            var blob = selectedFiles[i]; //ev.target.files[0];
            heic2any({
                blob: blob,
                toType: "image/jpeg",
                quality: 0.5,
            })
              .then((conversionResult) => {
                  let file = new File([conversionResult], i+"heic_convert.jpg",{type:"image/jpeg", lastModified:new Date().getTime()});
                  this.form.p_images.push(file);
                  console.log(this.form.p_images);
                  // console.log(file);
              })
              .catch((e) => {
                  console.log(e);
            });
          // this.form.p_images.push(selectedFiles[i]);
          // console.log(this.form.p_images);
        }
      },
      submit() {
        this.form.post('/update-product')
      }
    },

    components: {
    Layout,
    },
  }
</script>

<style scoped>
/* Toggle A */
input:checked ~ .dot {
  transform: translateX(100%);
  background-color: #4f46e4;
}

/* Toggle B */
input:checked ~ .dot {
  transform: translateX(100%);
  background-color: #4f46e4;
}
</style>
