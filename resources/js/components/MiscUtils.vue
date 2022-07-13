<template>
  <div id="page-content">
    <div class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h3 class="panel-title" style="font-weight: bold; font-size: 20px">
            <i class="fa fa-upload"></i> Miscellaneous Utilities
          </h3>
        </div>
        <div class="panel-body">
            <div class="row">
              <div class="col-md-6">
                <button
                    class="btn btn-sm btn-default" 
                    @click="showRevert=!showRevert">{{ showRevert==true ? 'Hide' : 'Show' }}
                </button>
                <card title="Revert Transaction/s">
                  <RevertTrans v-if="showRevert"></RevertTrans>
                </card>
              </div>
              <div class="col-md-6">
                <button
                    class="btn btn-sm btn-default" 
                    @click="showDelete=!showDelete">{{ showDelete==true ? 'Hide' : 'Show' }}
                </button>
                <card title="Delete Transaction/s">
                  <DeleteTrans v-if="showDelete"></DeleteTrans>
                </card>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <card title="Generate S.I. Test Data">
                  <GenerateSITest></GenerateSITest>
                </card>
              </div>
            </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import GenerateSITest from './misc_utils/GenerateSITest'
import RevertTrans from './misc_utils/RevertTrans'
import DeleteTrans from './misc_utils/DeleteTrans'

export default {
  name: 'MiscUtils',

  components: {
    GenerateSITest,
    RevertTrans,
    DeleteTrans
  },

  data() {
    return {
        showDelete: false,
        showRevert: false,
    }
  },

}
</script>
