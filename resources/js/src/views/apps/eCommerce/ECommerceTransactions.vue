<template>
  <vs-table :data="transactions">

    <template slot="thead">
      <vs-th>Staff</vs-th>
      <vs-th>Details Transaction</vs-th>
      <vs-th>Total Price</vs-th>
      <vs-th>Tax</vs-th>
      <vs-th>Total With Tax</vs-th>
    </template>

    <template slot-scope="{data}">
      <vs-tr :key="indextr" v-for="(tr, indextr) in data">

        <vs-td :data="data[indextr].staff_name">
          {{ data[indextr].staff_name }}
        </vs-td>

        <vs-td :data="data[indextr].carts">
            <vs-row v-for="(cart, index) in data[indextr].carts" :key="index">
                <vs-col v-tooltip="'col - 4'" vs-type="flex" vs-justify="center" vs-align="center" vs-w="4">
                    {{ cart.product_name }}
                </vs-col>

                <vs-col v-tooltip="'col - 4'" vs-type="flex" vs-justify="center" vs-align="center" vs-w="4">
                    x{{ cart.quantity }}
                </vs-col>

                <vs-col v-tooltip="'col - 4'" vs-type="flex" vs-justify="center" vs-align="center" vs-w="4">
                    {{ cart.product_price }}
                </vs-col>
            </vs-row>
        </vs-td>

        <vs-td :data="data[indextr].total_price">
          {{ data[indextr].total_price }}
        </vs-td>

        <vs-td :data="data[indextr].tax">
          {{ data[indextr].tax }}
        </vs-td>

        <vs-td :data="data[indextr].total_with_tax">
          {{ data[indextr].total_with_tax }}
        </vs-td>

      </vs-tr>
    </template>

  </vs-table>
</template>

<script>
import axios from '@/axios.js'

export default {
  data() {
    return {
        transactions: [],
    }
  },
  mounted() {
      this.fetchTransactions()
  },
  methods: {
      fetchTransactions() {
        axios.get('api/v1/transaction/list').then(response => {
            this.transactions = response.data.data
        })
      },
  }
}
</script>
