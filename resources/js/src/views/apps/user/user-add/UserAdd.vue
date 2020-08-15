<!-- =========================================================================================
  File Name: UserAdd.vue
  Description: User Add Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="page-user-add">
        <form-wizard
            ref="checkoutWizard"
            color="rgba(var(--vs-primary), 1)"
            :title="null"
            :subtitle="null"
            :hide-buttons="true"
        >
            <tab-content title="Account" icon="feather icon-user" class="mb-5">
                <vx-card>
                    <user-add-tab-account
                        class="mt-4"
                        :user-form="user_data"
                        @setUserForm="assignUserForm"
                        @toStoreForm="toStoreForm"
                    />
                </vx-card>
            </tab-content>

            <tab-content title="Store" icon="feather icon-shopping-cart" class="mb-5">
                <vx-card>
                    <user-add-tab-store
                        class="mt-4"
                        :store-form="store_data"
                        @setStoreForm="assignStoreForm"
                        @save="save"
                    />
                </vx-card>
            </tab-content>
        </form-wizard>
    </div>
</template>

<script>
import axios from '@/axios.js'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import { FormWizard, TabContent } from 'vue-form-wizard'
import UserAddTabStore       from "./UserAddTabStore.vue"
import UserAddTabAccount     from "./UserAddTabAccount.vue"

export default {
    components: {
        TabContent,
        FormWizard,
        UserAddTabStore,
        UserAddTabAccount,
    },
    data() {
        return {
            user_data: {
                avatar: null,
                username: null,
                email: null,
                password: null,
                status: null,
                role_id: null,
            },
            store_data: {
                admin_id: null,
                logo: null,
                name: null,
                address: null,
            },
            user_not_found: false,
            activeTab: 0,
        }
    },
    computed: {
        storeFormEnable() {
            return ! this.activeTab === 1
        }
    },
    methods: {
        assignUserForm(userForm) {
            Object.assign(this.user_data, userForm)
        },

        assignStoreForm(storeForm) {
            Object.assign(this.store_data, storeForm)
        },

        toStoreForm() {
            this.$refs.checkoutWizard.nextTab()
        },

        save() {
            axios.post('api/v1/user/store', this.user_data).then(response => {
                this.store_data.admin_id = response.data.id

                this.$nextTick(() => {
                    axios.post('api/v1/store/store', this.store_data)
                    .then(response => {
                        this.$vs.notify({
                            title: 'Success',
                            text: 'Create user success',
                            color: 'success',
                            iconPack: 'feather',
                            icon: 'icon-check'
                        })
                        this.$refs.checkoutWizard.prevTab()
                        this.resetForm()
                        this.$router.push('/apps/user/user-list')
                    })
                })
            })
        },

        resetForm() {
            this.user_data = {
                avatar: null,
                username: null,
                email: null,
                password: null,
                status: null,
                role_id: null,
            }

            this.store_data = {
                admin_id: null,
                logo: null,
                name: null,
                address: null,
            }
        },
    },
}

</script>
