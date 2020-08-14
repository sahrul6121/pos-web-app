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
    <vx-card>
      <div slot="no-body" class="tabs-container px-6 pt-6">

        <vs-tabs v-model="activeTab" class="tab-action-btn-fill-conatiner">
          <vs-tab label="Account" icon-pack="feather" icon="icon-user">
            <div class="tab-text">
              <user-add-tab-account class="mt-4" />
            </div>
          </vs-tab>
          <vs-tab label="Store" icon-pack="feather" icon="icon-shopping-cart">
            <div class="tab-text">
              <user-add-tab-store class="mt-4" />
            </div>
          </vs-tab>
        </vs-tabs>

      </div>

    </vx-card>
  </div>
</template>

<script>
import UserAddTabAccount     from "./UserAddTabAccount.vue"
import UserAddTabStore       from "./UserAddTabStore.vue"

export default {
  components: {
    UserAddTabAccount,
    UserAddTabStore,
  },
  data() {
    return {
      user_data: null,
      user_not_found: false,

      /*
        This property is created for fetching latest data from API when tab is changed

        Please check it's watcher
      */
      activeTab: 0,
    }
  },
}

</script>
