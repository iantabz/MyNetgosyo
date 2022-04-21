<!-- @format -->

<template>
  <div id="page-content">
    <div class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h3 class="panel-title" style="font-weight: bold; font-size: 20px">
            <i class="fa fa-vcard-o"></i> Setup Order Cut-off Time
          </h3>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
              <h1>Cut-off Time : {{ setup_time_display | formatTime }}</h1>
            </div>
          </div>
          <br />
          <div class="col-md-12">
            <div text-align="center">
              <form action="#" @submit.prevent="setTimeCutoff" method="post">
                <div class="col-md-6">
                  <input
                    type="time"
                    class="form-control"
                    v-model="form.time_cut_off"
                  />
                </div>
                <div class="col-md-3">
                  <button type="submit" class="btn btn-primary">
                    Setup Cut-off Time
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Datetime } from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
import format from 'date-fns/format'

export default {
  data() {
    return {
      form: {
        time_cut_off: ''
      },
      setup_time_display: ''
    }
  },
  components: {
    'date-time': Datetime
  },
  filters: {
    formatTime(value) {
      return format(new Date(`2021-01-01 ${value}`), 'p')
    }
  },
  methods: {
    async setTimeCutoff() {
      const { data } = await axios.post(
        `cut_off_time/set_time_cutoff`,
        this.form
      )
      alert(data.message)
      window.location.reload()
    },
    async retrieveTimeSetup() {
      const { data } = await axios.get(`cut_off_time/get_time_setup`)
      this.setup_time_display = data.cut_off_time

      //   console.log()
    }
  },
  mounted() {
    console.log('Component mounted.')
    this.retrieveTimeSetup()
    this.$root.currentPage = this.$route.meta.name
    $('#container').css('position', 'relative')
  }
}
</script>

<style lang="scss" scoped></style>
