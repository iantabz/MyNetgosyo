<template>
<div>
  <em>Note: Separate transaction numbers with a <strong>NEXT LINE</strong> 
    for reverting multiple transactions</em>
  <br/><br/><label>Transaction Number/s:</label>
  <textarea cols="30" rows="7" class="form-control mb-2" v-model="transaction_numbers"></textarea>
  <p class="bg-secondary" style="padding:2px;">{{ revert_transaction_status }}</p>
  <button class="btn btn-warning" @click="revertTransactions()"
    :disabled="transaction_numbers==''">Revert Transactions</button>
</div>
</template>

<script>
export default {
  name: 'RevertTrans',
  data() {
    return {
      transaction_numbers: '',
      revert_transaction_status: 'Ready',
    }
  },
  methods: {
    revertTransactions() {
      if(confirm('Are you sure you want to proceed?')) {
        const vm = this;
        let trans_nos = this.transaction_numbers.split('\n');
        if(trans_nos !== null) {
          trans_nos.forEach((val) => {
              
              const config = {
                onUploadProgress: function(progressEvent) {
                  var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
                  console.log(percentCompleted)
                  vm.revert_transaction_status = `Reverting transaction/s: ${val} - ${percentCompleted}%`;
                }
              }
              let data = {
                'transaction_number': val
              }
              axios.post(`/transaction/revert-transaction`,
                data, config
              ).then(response => {
                vm.revert_transaction_status = 'Ready';
              });

          });
        }
      }

    },
  },
}
</script>
