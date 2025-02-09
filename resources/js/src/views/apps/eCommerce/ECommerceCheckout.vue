    <!-- =========================================================================================
	File Name: ECommerceCheckout.vue
	Description: eCommerce Checkout page
	----------------------------------------------------------------------------------------
	Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
	Author: Pixinvent
	Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="ecommerce-checkout-demo">
        <!-- IF CART HAVE ITEMS -->
        <div class="vx-row" v-if="cartItems.length">

            <!-- LEFT COL -->
            <div class="vx-col lg:w-2/3 w-full relative">
                <div class="items-list-view" v-for="(item, index) in cartItems" :key="index">
                    <item-list-view :item="item" class="mb-base">

                        <!-- SLOT: ITEM META -->
                        <template slot="item-meta">
                            <h6
                                class="item-name font-semibold mb-1 cursor-pointer hover:text-primary"
                            >
                                {{ item.product_name }}
                            </h6>
                            <p class="text-sm mb-2">By <span class="font-semibold cursor-pointer">{{ item.store_name }}</span></p>
                            <p class="text-success text-sm">In Stock</p>

                            <p class="mt-4 font-bold text-sm">Quantity</p>
                            <vs-input-number min="1" max="999" :value="item.quantity" @input="updateItemQuantity($event, item)" class="inline-flex" />

                            <p class="font-medium text-grey mt-4">Ordered at, {{ item.ordered_at }}</p>
                        </template>

                        <!-- SLOT: ACTION BUTTONS -->
                        <template slot="action-buttons">

                            <!-- PRIMARY BUTTON: REMOVE -->
                            <div class="item-view-primary-action-btn p-3 rounded-lg flex flex-grow items-center justify-center cursor-pointer mb-3" @click="removeProduct(item)">
                                <feather-icon icon="XIcon" svgClasses="h-4 w-4" />
                                <span class="text-sm font-semibold ml-2">REMOVE</span>
                            </div>
                        </template>
                    </item-list-view>
                </div>
            </div>

            <!-- RIGHT COL -->
            <div class="vx-col lg:w-1/3 w-full" v-if="cartDetails">
                <vx-card>
                    <p class="font-semibold mb-3">Price Details</p>
                    <div class="flex justify-between mb-2">
                        <span class="text-grey">Total</span>
                        <span>{{ cartDetails.total_price_formatted }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-grey">Tax</span>
                        <span>{{ cartDetails.tax_formatted }}</span>
                    </div>

                    <vs-divider />

                    <div class="flex justify-between font-semibold mb-3">
                        <span>Total</span>
                        <span>{{ cartDetails.total_price_with_tax_formatted }}</span>
                    </div>

                    <vs-button class="w-full" @click="addTransaction()">Add Transaction</vs-button>
                </vx-card>
            </div>
        </div>

        <!-- IF NO ITEMS IN CART -->
        <vx-card title="You don't have any items in your transaction." v-else>
            <vs-button @click="$router.push('/apps/eCommerce/list/product').catch(() => {})">Browse Product</vs-button>
        </vx-card>
    </div>
</template>

<script>
import axios from '@/axios.js'
const ItemListView = () => import('./components/ItemListView.vue')

export default {
    data() {
        return {

            // TAB 2
            fullName: "",
            mobileNum: "",
            pincode: "",
            houseNum: "",
            area: "",
            landmark: "",
            city: "",
            state: "",
            addressType: 1,
            addressTypeOptions: [
                { text: 'Home', value: 1 },
                { text: 'Office', value: 2 },
            ],

            // TAB 3
            paymentMethod: "debit-card",
            cvv: '',
            cartItems: [],
            cartDetails: null,
        }
    },
    computed: {
        isInWishList() {
            return (itemId) => this.$store.getters['eCommerce/isInWishList'](itemId)
        },
    },
    mounted() {
        this.fetchCartItems()
        this.fetchCartDetails()
    },
    methods: {

        // TAB 1
        removeItemFromCart(item) {
            this.$store.dispatch('eCommerce/toggleItemInCart', item)
        },

        updateItemQuantity(quantity, item) {
            if (quantity > item.quantity) {
                axios.post('api/v1/cart/add/product/' + item.product_id).then(response => {
                    this.$vs.notify({
                        title: 'Success',
                        text: 'Product quantity increased.',
                        color: 'success',
                        iconPack: 'feather',
                        icon: 'icon-check'
                    })
                    this.fetchCartItems()
                    this.fetchCartDetails()
                })
            } else {
                axios.post('api/v1/cart/decrease/product/' + item.product_id).then(response => {
                    this.$vs.notify({
                        title: 'Success',
                        text: 'Product quantity decreased.',
                        color: 'success',
                        iconPack: 'feather',
                        icon: 'icon-check'
                    })
                    this.fetchCartItems()
                    this.fetchCartDetails()
                })
            }
        },

        fetchCartItems() {
            axios.get('api/v1/cart/list').then(response => {
                this.cartItems = response.data.data
            })
        },

        fetchCartDetails() {
            axios.get('api/v1/cart/details').then(response => {
                this.cartDetails = response.data.data
            })
        },

        removeProduct(item) {
            axios.post('api/v1/cart/remove/product/' + item.product_id).then(response => {
                this.$vs.notify({
                    title: 'Success',
                    text: 'Product removed.',
                    color: 'success',
                    iconPack: 'feather',
                    icon: 'icon-check'
                })
                this.fetchCartItems()
                this.fetchCartDetails()
            })
        },

        addTransaction() {
            let cartId = []

            this.cartItems.forEach(cart => {
                cartId.push(cart.id)
            });

            let form = this.cartDetails

            form = Object.assign(form, {
                carts: cartId,
            });

            axios.post('api/v1/transaction/store', form).then(response => {
                this.$vs.notify({
                    title: 'Success',
                    text: 'Transaction success.',
                    color: 'success',
                    iconPack: 'feather',
                    icon: 'icon-check'
                })
                this.fetchCartItems()
                this.fetchCartDetails()
            })
        },
    },
    components: {
        ItemListView,
    }
}
</script>

<style lang="scss" scoped>
#ecommerce-checkout-demo {
    .item-view-primary-action-btn {
        color: #2c2c2c !important;
        background-color: #f6f6f6;
    }

    .item-name {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        -webkit-line-clamp: 2;
    }

    .vue-form-wizard {
        padding-bottom: 0;

        ::v-deep .wizard-header {
            padding: 0;
        }

        ::v-deep .wizard-tab-content {
            padding-right: 0;
            padding-left: 0;
            padding-bottom: 0;

            .wizard-tab-container{
              margin-bottom: 0 !important;
            }
        }
    }
}
</style>
