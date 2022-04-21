<template>
  <span 
    class="badge badge-warning" 
    title="Ongoing Transactions (Pending)"
    v-if="getOngoingPendingCount > 0"
  >{{ getOngoingPendingCount }}</span>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data() {
    return {

    }
  },

  methods: {
    //
  },

  computed: {
    ...mapGetters('transactions', [
      'getOngoingPendingCount'
    ])
  },

  created() {
    
  },

}
</script>