<template>
    <div class="mt-10 sm:mt-0">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Create New Store</h3>
          <p class="mt-1 text-sm text-gray-600">
            Carefully Complete All The Fields
          </p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form @submit.prevent="submit">
          <div class="shadow overflow-hidden sm:rounded-md">
            <h3>Your Information</h3>
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="user_name" class="block text-sm font-medium text-gray-700">Name</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.user_name">{{ errors.user_name }}</div>
                  <input type="text" v-model="form.user_name" id="user_name" autocomplete="user_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="user_phone" class="block text-sm font-medium text-gray-700">Phone</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.user_phone">{{ errors.user_phone }}</div>
                  <input type="text" v-model="form.user_phone" id="user_phone" autocomplete="user_phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="user_email" class="block text-sm font-medium text-gray-700">Email</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.user_email">{{ errors.user_email }}</div>
                  <input type="email" name="user_email" v-model="form.user_email" id="user_email" autocomplete="user_email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="user_password" class="block text-sm font-medium text-gray-700">Password</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.user_password">{{ errors.user_password }}</div>
                  <input type="password" name="user_password" v-model="form.user_password" id="user_password" autocomplete="user_password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="user_confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.user_confirm_password">{{ errors.user_confirm_password }}</div>
                  <input type="password" name="user_confirm_password" v-model="form.user_confirm_password" id="user_confirm_password" autocomplete="user_confirm_password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>
              </div>
            </div>
            <h3>Store Information</h3>
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="store_name" class="block text-sm font-medium text-gray-700">Store name</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.store_name">{{ errors.store_name }}</div>
                  <input type="text" v-model="form.store_name" id="store_name" autocomplete="store_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="store_phone" class="block text-sm font-medium text-gray-700">Store Phone</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.store_phone">{{ errors.store_phone }}</div>
                  <input type="text" v-model="form.store_phone" id="store_phone" autocomplete="store_phone" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="store_email" class="block text-sm font-medium text-gray-700">Store Email</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.store_email">{{ errors.store_email }}</div>
                  <input type="email" v-model="form.store_email" id="store_email" autocomplete="store_email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="store_address" class="block text-sm font-medium text-gray-700">Store Address</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.store_address">{{ errors.store_address }}</div>
                  <input type="text" name="store_address" v-model="form.store_address" id="store_address" autocomplete="store_address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="store_type" class="block text-sm font-medium text-gray-700">Store Type</label>
                  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" v-if="errors.store_type">{{ errors.store_type }}</div>
                  <select id="store_type" name="store_type" v-model="form.store_type" autocomplete="store_type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option>-- Select Store Type --</option>
                    <option value="degital">Degital</option>
                    <option value="Medical">Medical</option>
                    <option value="other">Other</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Save
              </button>
              
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
  
  import Layout from '../AdminLayout'
  import { useForm } from '@inertiajs/inertia-vue3'

  export default {
    data() {
      return { 
        form: this.$inertia.form({
          
          //user info
          user_name: null,
          user_phone: null,
          user_email: null,
          user_password: null,
          user_confirm_password: null,

          //store info
          store_name: null,
          store_phone: null,
          store_email: null,
          store_address: null,
          store_type: null,
        })
        }
    },

    methods: {
      submit() {
        this.form.post('/save-user')
      }
    },
    
    props: {
    errors: Object,
    },

    components: {
    Layout,
    },
  }
</script>
