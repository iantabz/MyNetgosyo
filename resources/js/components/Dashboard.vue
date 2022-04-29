<!-- @format -->

<template>
  <div id="page-content">
    <div class="panel">
      <div class="panel-body">
          <div class="row">

            <div class="col-md-3">
              <div class="panel panel-success" style="background-color:#f7f7f7;">
                <div class="panel-heading">
                  <div class="panel-title">
                    Average Orders Per Day
                  </div>
                </div>
                <div class="panel-body" style="padding:0 16px;">
                  <h3 style="margin:6px 0;">{{ Math.round(averageTransactionsPerDay) }}</h3>
                </div>
              </div>
            </div>

            

          </div>
      </div>
    </div>

  </div>
</template>
<style>
/** @format */

@media screen and (min-width: 768px) {
  .modal-dialog {
    width: 700px; /* New width for default modal */
  }
  .modal-sm {
    width: 350px; /* New width for small modal */
  }
  .modal-header {
    background-color: #ff5722;
  }
  .modal-title {
    color: #ffffff;
  }
  .close {
    color: #ffffff;
  }
}
@media screen and (min-width: 992px) {
  .modal-lg {
    width: 1250px; /* New width for large modal */
  }
  .modal-header {
    background-color: #ff5722;
  }
  .modal-title {
    color: #ffffff;
  }
  .close {
    color: #ffffff;
  }
}
</style>

<script>

export default {
  async beforeCreate() {
    const { data } = await axios.get('/getAuthUser')

    if (data.type !== 'Admin') {
      if (data.type === 'Supervisor') {
        location.replace('/dashboard1')
      }
      if (data.type === 'Manager') {
        location.replace('/dashboard1')
      }
      if (data.type === 'Customer Service') {
        location.replace('/dashboard2')
      }
      if (data.type === 'Accounting') {
        location.replace('/dashboard2')
      }
      if (data.type === 'Internal Audit') {
        location.replace('/dashboard2')
      }
      if (data.type === 'MIS') {
        location.replace('/dashboard3')
      }
    }
  },
  data() {
    return {
      averageTransactionsPerDay: 0,
    }
  },
  components: {
    // datetime: Datetime
  },
  watch: {

  },
  computed: {
    
  },
  methods: {
    initAverageTransactionsPerDay() {
        const vm = this;
        axios.get('/average-transactions-per-day')
        .then(response => {
          vm.averageTransactionsPerDay = response.data.average;
        })
        .catch(error => {
          console.log(error)
        });
          
      }
  },
  created() {
    this.initAverageTransactionsPerDay();
  },
  mounted() {
    this.$root.currentPage = this.$route.meta.name
    console.log('Dashboard Mounted')
  }
}
</script>
