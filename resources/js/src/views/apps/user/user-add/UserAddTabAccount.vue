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

    <!-- Avatar Row -->
    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="flex items-start flex-col sm:flex-row">
          <img :src="avatar" class="mr-8 rounded h-24 w-24" />

          <div>
            <input v-validate="'required'" type="file" class="hidden" ref="update_avatar_input" @change="update_avatar" accept="image/*" name="avatar">

            <vs-button class="mr-4 mb-4" @click="$refs.update_avatar_input.click()">Change Avatar</vs-button>
          </div>
        </div>

        <span class="text-danger text-sm"  v-show="errors.has('avatar')">{{ errors.first('avatar') }}</span>
      </div>
    </div>

    <!-- Content Row -->
    <div class="vx-row">
      <div class="vx-col md:w-1/2 w-full">
        <vs-input class="w-full mt-4" label="Username" icon-pack="feather" icon="icon-user" icon-no-border v-model="form.username" v-validate="'required|alpha_num'" name="username" />
        <span class="text-danger text-sm"  v-show="errors.has('username')">{{ errors.first('username') }}</span>

        <vs-input class="w-full mt-4" label="Email" icon-pack="feather" icon="icon-mail" icon-no-border v-model="form.email" type="email" v-validate="'required|email'" name="email" />
        <span class="text-danger text-sm"  v-show="errors.has('email')">{{ errors.first('email') }}</span>

        <vs-input type="password" label="Password" class="w-full mt-4" icon-pack="feather" icon="icon-lock" icon-no-border v-validate="'required|min:6'" v-model="form.password" name="password" />
        <span class="text-danger text-sm"  v-show="errors.has('password')">{{ errors.first('password') }}</span>
      </div>

      <div class="vx-col md:w-1/2 w-full">

        <div class="mt-4">
          <label class="vs-input--label">Status</label>
          <v-select v-model="selectedStatus" :clearable="true" :options="statusOptions" v-validate="'required'" name="status" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
          <span class="text-danger text-sm"  v-show="errors.has('status')">{{ errors.first('status') }}</span>
        </div>

        <div class="mt-4">
          <label class="vs-input--label">Role</label>
          <v-select v-model="selectedRole" :clearable="true" :options="roleOptions" v-validate="'required'" name="role" :dir="$vs.rtl ? 'rtl' : 'ltr'" />
          <span class="text-danger text-sm"  v-show="errors.has('role')">{{ errors.first('role') }}</span>
        </div>
      </div>
    </div>

    <!-- Save & Reset Button -->
    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="mt-8 flex flex-wrap items-center justify-end">
          <vs-button class="ml-auto mt-2" @click="save_changes" :disabled="!validateForm">Next</vs-button>
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
        avatar: null,
        form: {
            avatar: null,
            username: null,
            email: null,
            password: null,
            status: null,
            role_id: null,
        },
        statusOptions: [
            { label: "Active",  value: true },
            { label: "Deactivated",  value: false },
        ],
        roleOptions: [],
        errorMessage: {
            ext: '',
            size: '',
        },
        selectedRole: null,
        selectedStatus: null,
    }
  },
  computed: {
    validateForm() {
      return !this.errors.any()
    },

    selectedRoleValue() {
        if (this.selectedRole != null) {
            return this.selectedRole.value
        }

        return null
    },

    selectedStatusValue() {
        if (this.selectedStatus != null) {
            return this.selectedStatus.value
        }

        return null
    },
  },
  watch: {
    selectedRoleValue() {
        this.form.role_id = this.selectedRoleValue
    },

    selectedStatusValue() {
        this.form.status = this.selectedStatusValue
    },
  },
  mounted() {
    this.fetchRoles();
  },
  methods: {
    capitalize(str) {
      return str.slice(0,1).toUpperCase() + str.slice(1,str.length)
    },

    save_changes() {
        // this.$validator.validateAll().then(result => {
        //     if(result) {
        //         axios.post('api/v1/user/store', this.form)
        //         .then(response => {
        //             alert('success')
        //         })
        //     }
        // })
        this.$emit('toStoreForm')
    },

    reset_data() {
      this.avatar = null
      this.form = {
        avatar: null,
        username: null,
        email: null,
        password: null,
        status: null,
        role_id: null,
      }
    },

    update_avatar(event) {
      const input = event.target
      const files = input.files[0]

      if (this.isValidExt(files) && this.isValidSize(files)) {
          const formData = new FormData()

          formData.append('avatar', files)
          formData.append('_method', 'POST')

          axios.post('api/v1/user/upload/avatar', formData)
          .then(response => {
              this.avatar = response.data.avatar_url
              this.form.avatar = response.data.avatar_path
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

    fetchRoles() {
        axios.get('api/v1/roles')
        .then(response => {
            this.roleOptions = response.data.data
        })
    }
  },
}
</script>
