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
          <img :src="formData.logo" class="mr-8 rounded h-24 w-24" />

          <div>
            <!-- <p class="text-lg font-medium mb-2 mt-4 sm:mt-0">{{ data.name  }}</p> -->
            <input type="file" class="hidden" ref="update_avatar_input" @change="update_avatar" accept="image/*">

            <!-- Toggle comment of below buttons as one for actual flow & currently shown is only for demo -->
            <vs-button class="mr-4 mb-4">Change Store Logo</vs-button>
            <!-- <vs-button type="border" class="mr-4" @click="$refs.update_avatar_input.click()">Change Avatar</vs-button> -->

            <!-- <vs-button type="border" color="danger">Remove Store Logo</vs-button> -->
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

export default {
  components: {
    vSelect
  },
  data() {
    return {
        formData: {
            logo: null,
        },

        form: {
            id: null,
            name: null,
            address: null,
        },
    }
  },
  computed: {
    status_local: {
      get() {
        return { label: this.capitalize(this.form.status),  value: this.form.status  }
      },
      set(obj) {
        this.form.status = obj.value
      }
    },
    role_local: {
      get() {
        return { label: this.capitalize(this.form.role),  value: this.form.role  }
      },
      set(obj) {
        this.form.role = obj.value
      }
    },
    validateForm() {
      return !this.errors.any()
    }
  },
  methods: {
    capitalize(str) {
      return str.slice(0,1).toUpperCase() + str.slice(1,str.length)
    },
    save_changes() {
      if(!this.validateForm) return

      // Here will go your API call for updating data
      // You can get data in "this.data_local"

    },
    reset_data() {
      this.form = {
        id: null,
        username: null,
        email: null,
        password: null,
        status: null,
        role_slug: null,
      }
    },
    update_avatar() {
      // You can update avatar Here
      // For reference you can check dataList example
      // We haven't integrated it here, because data isn't saved in DB
    }
  },
}
</script>
