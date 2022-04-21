<template>
<div>
  <em>Note: Separate transaction numbers with a <strong>NEXT LINE</strong> 
    for deleting multiple transactions</em>
  <br/><br/><label>Transaction Number/s:</label>
  <textarea cols="30" rows="7" class="form-control mb-2" v-model="transaction_numbers"></textarea>
  <p class="bg-secondary" style="padding:2px;">{{ del_tran_status }}</p>
  <button class="btn btn-danger" @click="deleteTransactions()" 
    :disabled="transaction_numbers==''">Delete Transactions</button>
</div>
</template>

<script>
export default {
  name: 'DeleteTrans',
  data() {
    return {
      transaction_numbers: '',
      del_tran_status: 'Ready',
    }
  },
  methods: {
    deleteTransactions() {
      if(confirm('Are you sure you want to proceed?')) {
        const vm = this;
        let trans_nos = this.transaction_numbers.split('\n');
        if(trans_nos !== null) {
          trans_nos.forEach((val) => {
              
              const config = {
                onUploadProgress: function(progressEvent) {
                  var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total)
                  console.log(percentCompleted)
                  vm.del_tran_status = `Reverting transaction/s: ${val} - ${percentCompleted}%`;
                }
              }
              let data = {
                'transaction_number': val
              }
              axios.post(`/transaction/delete-transaction`,
                data, config
              ).then(response => {
                vm.del_tran_status = 'Ready';
              });

          });
        }
      }
    },
  },
}
</script>
