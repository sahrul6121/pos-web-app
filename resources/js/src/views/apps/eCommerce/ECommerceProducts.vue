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
            v-for="(product, index) in products" :key="index"
        >
            <vx-card>
                <img :src="product.image" alt="content-img" class="responsive rounded-lg img-size">
                <div class="my-6">
                    <h5 class="mb-2">{{ product.name }}</h5>
                    <p class="text-grey">Created By {{ product.creator_name }}</p>
                </div>
                <vs-divider></vs-divider>
                <div class="flex justify-between flex-wrap">
                    <span>
                        <p class="text-xl">{{ product.price }}</p>
                        <p class="text-grey">Price</p>
                    </span>
                    <span>
                        <p class="text-xl">{{ product.stock }}</p>
                        <p class="text-grey">Stock</p>
                    </span>
                    <span>
                        <p class="text-xl">{{ product.discount_percentage }} %</p>
                        <p class="text-grey">Discount</p>
                    </span>
                    <span>
                        <vs-button radius color="success" type="gradient" icon-pack="feather" icon="icon-shopping-cart" @click="addToCart(product.id)" />
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
            products: [],
            filter: {
                perPage: 10,
                page: 1,
            }
        }
    },
    mounted() {
        this.fetchproducts()
    },
    methods: {
        fetchproducts() {
            axios.get('api/v1/product/list').then(response => {
                this.products = response.data.data
            })
        },

        addToCart(productId) {
            axios.post('api/v1/cart/add/product/' + productId).then(response => {
                this.$vs.notify({
                    title: 'Success',
                    text: 'Add product to transaction success',
                    color: 'success',
                    iconPack: 'feather',
                    icon: 'icon-check'
                })
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
