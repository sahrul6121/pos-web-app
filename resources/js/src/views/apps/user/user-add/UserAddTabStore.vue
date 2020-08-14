<!-- =========================================================================================
  File Name: UserAddTabStore.vue
  Description: User Add Store Tab content
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="user-add-tab-store">

    <!-- Avatar Row -->
    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="flex items-start flex-col sm:flex-row">
          <img :src="logo" class="mr-8 rounded h-24 w-24" />

          <div>
            <input type="file" class="hidden" ref="update_avatar_input" @change="update_avatar" accept="image/*">

            <vs-button class="mr-4 mb-4" @click="$refs.update_avatar_input.click()">Change Store Logo</vs-button>
          </div>
        </div>
      </div>
    </div>

    <!-- Content Row -->
    <div class="vx-row">
      <div class="vx-col md:w-1/2 w-full">
        <vs-input class="w-full mt-4" label="Store Name" icon-pack="feather" icon="icon-shopping-cart" icon-no-border v-model="form.name" v-validate="'required|alpha_num'" name="name" />
        <span class="text-danger text-sm"  v-show="errors.has('name')">{{ errors.first('name') }}</span>
      </div>

      <div class="vx-col md:w-1/2 w-full">
        <vs-input class="w-full mt-4" label="Store Address" icon-pack="feather" icon="icon-map" icon-no-border v-model="form.address" type="email" v-validate="'required'" name="address" />
        <span class="text-danger text-sm"  v-show="errors.has('address')">{{ errors.first('address') }}</span>
      </div>
    </div>

    <!-- Save & Reset Button -->
    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="mt-8 flex flex-wrap items-center justify-end">
          <vs-button class="ml-auto mt-2" @click="save_changes" :disabled="!validateForm">Save</vs-button>
          <vs-button class="ml-4 mt-2" type="border" color="warning" @click="reset_data">Reset</vs-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vSelect from 'vue-select'
import axios from '@/axios.js'

export default {
  components: {
    vSelect
  },
  data() {
    return {
        logo: null,
        errorMessage: {
            ext: '',
            size: '',
        },
        form: {
            logo: null,
            name: null,
            address: null,
        },
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any()
    },
  },
  methods: {
    reset_data() {
      this.form = {
        logo: null,
        name: null,
        address: null,
      }
    },

    save_changes() {
        //
    },

    update_avatar(event) {
      const input = event.target
      const files = input.files[0]

      if (this.isValidExt(files) && this.isValidSize(files)) {
          const formData = new FormData()

          formData.append('logo', files)
          formData.append('_method', 'POST')

          axios.post('api/v1/store/upload/logo', formData)
          .then(response => {
              this.logo = response.data.logo_url
              this.form.logo = response.data.logo_path
          })
      }
    },

    isValidExt(image) {
      const imgExt = ['JPEG', 'JPG', 'PNG']
      const isValid = imgExt.includes(image.name.split('.').pop().toUpperCase())

      if (!isValid) {
        this.errorMessage.ext = 'File extension must JPG, JPEG, PNG.'
      } else {
        this.errorMessage.ext = ''
      }

      return isValid
    },

    isValidSize(image) {
      let isValid = false

      if (image.size >= 5000000) {
        this.errorMessage.size = 'File size max 5mb.'
        isValid = false
      } else {
        this.errorMessage.size = ''
        isValid = true
      }

      return isValid
    },
  },
}
</script>
