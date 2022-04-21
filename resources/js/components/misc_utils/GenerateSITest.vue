
<template>
<div>
  <form @submit.prevent="submitFile()" enctype="multipart/form-data">
    <div class="row">
      <div class="form-group col-md-8">
        <input
          type="file"
          id="file"
          accept=".csv,.txt"
          
          class="form-control"
          
          @change="handleFileUpload( $event )"
        />
        <!-- style="border: 1px solid #ccc;display: inline-block;padding: 6px 12px;cursor: pointer;" -->
      </div>
      <div class="form-group col-md-4">
        <button class="form-control btn btn-primary">Generate Test Data</button>
      </div>
      <div class="form-group col-md-12">
        <textarea cols="30" rows="15" class="form-control" v-model="invoices_data"></textarea>
      </div>
    </div>
  </form>
</div>
</template>

<script>
export default {
  name: 'GenerateSITest',
  data() {
    return {
      file: '',
      invoices_data: ''
    }
  },
  methods: {
    submitFile() {
      let formData = new FormData()
      formData.append('file', this.file)

      axios.post( '/consolidated/generate_si_test',
        formData,
        {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
        }
      ).then(response => {
        this.invoices_data = response.data
      })
      .catch(err => {
        this.invoices_data = `ERR:${err}`
      })

    },

    handleFileUpload(event) {
      this.file = event.target.files[0]
    },
  },
}
</script>
