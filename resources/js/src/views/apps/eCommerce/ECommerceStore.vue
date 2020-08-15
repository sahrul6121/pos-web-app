<!-- =========================================================================================
  File Name: ECommerceShop.vue
  Description: eCommerce Shop Page
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->
<template>
    <div class="vx-row">
        <div
            class="vx-col w-full sm:w-1/2 lg:w-1/3 mb-base"
            v-for="(store, index) in stores" :key="index"
        >
            <vx-card>
                <img :src="store.logo" alt="content-img" class="responsive rounded-lg img-size">
                <div class="my-6">
                    <h5 class="mb-2">{{ store.name }}</h5>
                    <p class="text-grey">Owner {{ store.owner_name }}</p>
                </div>
                <vs-divider></vs-divider>
                <div class="flex justify-between flex-wrap">
                    <span>
                        <p class="text-xl">{{ store.income }}</p>
                        <p class="text-grey">Income</p>
                    </span>
                    <span>
                        <p class="text-xl">{{ store.product_count }}</p>
                        <p class="text-grey">Product</p>
                    </span>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
import axios from '@/axios.js'

export default {
    data() {
        return {
            stores: [],
            filter: {
                perPage: 10,
                page: 1,
            }
        }
    },
    mounted() {
        this.fetchStores()
    },
    methods: {
        fetchStores() {
            axios.get('api/v1/store/list').then(response => {
                this.stores = response.data.data
            })
        },
    },
}
</script>

<style scoped>
    .img-size {
        height: 300px;
        width: 100%;
    }
</style>
