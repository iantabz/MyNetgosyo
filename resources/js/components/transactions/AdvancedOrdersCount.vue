<template>
  <span 
    class="badge badge-warning" 
    title="Advanced Orders"
    v-if="getAdvancedOrdersCount > 0"
  >{{ getAdvancedOrdersCount }}</span>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data() {
    return {
      // advanced_orders_count: null
    }
  },

  computed: {
    ...mapGetters('transactions',[
      'getAdvancedOrdersCount'
    ])
  },

}
</script>