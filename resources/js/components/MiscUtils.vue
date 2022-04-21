<template>
  <div id="page-content">
    <div class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h3 class="panel-title" style="font-weight: bold; font-size: 20px">
            <i class="fa fa-upload"></i> Miscellaneous Utilities
          </h3>
        </div>
        <div class="row">
          <div class="col-md-6">
            <card title="Revert Transaction/s">
              <RevertTrans></RevertTrans>
            </card>
          </div>
          <div class="col-md-6">
            <card title="Test 1">
              <DeleteTrans></DeleteTrans>
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

    }
  },

}
</script>
