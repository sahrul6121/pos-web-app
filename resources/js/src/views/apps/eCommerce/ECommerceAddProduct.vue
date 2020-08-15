<!-- =========================================================================================
  File Name: UserAddTabAccount.vue
  Description: User Add Account Tab content
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div id="user-add-tab-account">
    <vx-card>
    <!-- Avatar Row -->
    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="flex items-start flex-col sm:flex-row">
          <img :src="picture" class="mr-8 rounded h-24 w-24" />

          <div>
            <input v-validate="'required'" type="file" class="hidden" ref="update_avatar_input" @change="update_avatar" accept="image/*" name="avatar">

            <vs-button class="mr-4 mb-4" @click="$refs.update_avatar_input.click()">Change Product Image</vs-button>
          </div>
        </div>

        <span class="text-danger text-sm"  v-show="errors.has('avatar')">{{ errors.first('avatar') }}</span>
      </div>
    </div>

    <!-- Content Row -->
    <div class="vx-row">
      <div class="vx-col md:w-1/2 w-full">
        <vs-input class="w-full mt-4" label="Name" v-model="form.name" v-validate="'required'" name="name" />
        <span class="text-danger text-sm"  v-show="errors.has('name')">{{ errors.first('name') }}</span>

        <vs-input class="w-full mt-4" label="Stock" v-model="form.stock" v-validate="'required|integer'" name="stock" />
        <span class="text-danger text-sm"  v-show="errors.has('stock')">{{ errors.first('stock') }}</span>

        <vs-input label="Price" class="w-full mt-4" v-validate="'required|integer'" v-model="form.price" name="price" />
        <span class="text-danger text-sm"  v-show="errors.has('price')">{{ errors.first('price') }}</span>
      </div>

      <div class="vx-col md:w-1/2 w-full">

        <div class="mt-4">
          <label class="vs-input--label">Status</label>
          <v-select v-model="selectedStatus" :clearable="true" :options="statusOptions" v-validate="'required'" name="status" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
          <span class="text-danger text-sm"  v-show="errors.has('status')">{{ errors.first('status') }}</span>
        </div>

        <div class="mt-4">
          <vs-input class="w-full mt-4" label="Discount Percentage" icon-pack="feather" icon="icon-percent" icon-after icon-no-border v-model="form.discount_percentage" v-validate="'required|integer'" name="discount percentage" />
          <span class="text-danger text-sm"  v-show="errors.has('discount percentage')">{{ errors.first('discount percentage') }}</span>
        </div>
      </div>
    </div>

    <!-- Save & Reset Button -->
    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="mt-8 flex flex-wrap items-center justify-end">
          <vs-button class="ml-auto mt-2" @click="save_changes" :disabled="!validateForm">Save</vs-button>
        </div>
      </div>
    </div>

    </vx-card>

  </div>
</template>

<script>
import axios from '@/axios.js'
import vSelect from 'vue-select'

export default {
  components: {
    vSelect
  },
  data() {
    return {
        picture: null,
        form: {
            name: null,
            price: null,
            discount_percentage: null,
            stock: null,
            status: null,
            picture: null,
        },
        statusOptions: [
            { label: "Available",  value: true },
            { label: "Not Avaailable",  value: false },
        ],
        errorMessage: {
            ext: '',
            size: '',
        },
        selectedStatus: null,
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any()
    },

    selectedStatusValue() {
        if (this.selectedStatus != null) {
            return this.selectedStatus.value
        }

        return null
    },
  },
  watch: {
    selectedStatusValue() {
        this.form.status = this.selectedStatusValue
    },
  },
  methods: {
    capitalize(str) {
      return str.slice(0,1).toUpperCase() + str.slice(1,str.length)
    },

    save_changes() {
        this.$validator.validateAll().then(result => {
            if (result) {
               axios.post('api/v1/product/store', this.form).then(response => {
                    this.reset_data()
                    this.$vs.notify({
                        title: 'Success',
                        text: 'Create product success',
                        color: 'success',
                        iconPack: 'feather',
                        icon: 'icon-check'
                    })
               })
            }
        })
    },

    reset_data() {
      this.picture = null
      this.form = {
        name: null,
        picture: null,
        price: null,
        discount_percentage: null,
        status: null,
        stock: null,
      }
      this.selectedStatus = null
    },

    update_avatar(event) {
      const input = event.target
      const files = input.files[0]

      if (this.isValidExt(files) && this.isValidSize(files)) {
          const formData = new FormData()

          formData.append('picture', files)
          formData.append('_method', 'POST')

          axios.post('api/v1/product/upload/picture', formData)
          .then(response => {
              this.picture = response.data.picture_url
              this.form.picture = response.data.picture_path
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
