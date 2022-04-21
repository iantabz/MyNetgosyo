<!-- @format -->

<template>
  <div id="page-body">
    <div class="panel">
      <div class="panel-body">
        <div class="panel-heading">
          <h3
            style="font-weight: bold; font-size: 20px; padding: 15px 0 0 25px"
          >
            <i class="fa fa-users"></i> Customer Feedbacks
          </h3>
        </div>
        <hr class="new-section-sm mar-all mar-btm" />
        <div class="panel-body">
          <div
            class="comments media-block"
            v-if="!feedbacks.data.length"
            style="text-align: center"
          >
            <span class="text-main text-bold">
              No data available.
            </span>
          </div>
          <div
            class="comments media-block"
            v-for="(data, index) in feedbacks.data"
            :key="index"
          >
            <div class="pull-right">
              <a
                href="javascript:;"
                class="add-tooltip btn btn-trans"
                data-original-title="Favorite"
                ><span class="favorite-color"
                  ><i class="demo-psi-star icon-lg"></i></span
              ></a>
              <a
                href="javascript:;"
                class="add-tooltip btn btn-trans"
                data-original-title="Favorite"
                ><span class="unfavorite-color"
                  ><i class="demo-psi-star icon-lg"></i></span
              ></a>
              <a
                href="javascript:;"
                class="add-tooltip btn btn-trans"
                data-original-title="Favorite"
                ><span class="unfavorite-color"
                  ><i class="demo-psi-star icon-lg"></i></span
              ></a>
              <a
                href="javascript:;"
                class="add-tooltip btn btn-trans"
                data-original-title="Favorite"
                ><span class="unfavorite-color"
                  ><i class="demo-psi-star icon-lg"></i></span
              ></a>
              <a
                href="javascript:;"
                class="add-tooltip btn btn-trans"
                data-original-title="Favorite"
                ><span class="unfavorite-color"
                  ><i class="demo-psi-star icon-lg"></i></span
              ></a>
            </div>
            <a class="media-left" href="#"
              ><img
                class="img-circle img-sm"
                alt="Profile Picture"
                src="assets/img/profile-photos/1.png"
            /></a>
            <div class="media-body">
              <div class="comment-header">
                <a
                  href="#"
                  class="media-heading box-inline text-main text-bold"
                  >{{
                    data.hasOwnProperty('customer_details') &&
                      data.customer_details.account_name
                  }}</a
                >
                <p class="text-muted text-sm">
                  <!-- <i class="demo-pli-smartphone-3 icon-lg"></i> Mobile - -->
                  {{ data.feedback_date | formatDate }}
                </p>
              </div>
              <p>{{ data.feedback }}</p>
              <a class="btn btn-sm btn-default"
                ><i class="icon-lg demo-pli-like"></i> Like
              </a>
              <!-- <a class="btn btn-sm btn-default"
                ><i class="icon-lg demo-pli-right-4"></i> Reply</a
              > -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
              Showing {{ feedbacks.from }} to {{ feedbacks.to }} of
              <span class="text-main text-bold">
                {{ feedbacks.total }} entries
              </span>
            </div>
            <div class="col-md-6">
              <div class="text-right">
                <pagination
                  style="margin: 0 0 20px 0"
                  :limit="1"
                  :show-disabled="true"
                  :data="feedbacks"
                  @pagination-change-page="getResults"
                ></pagination>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      feedbacks: {
        data: []
      }
    }
  },
  methods: {
    async getResults(page = 1) {
      let url = `/feedbacks/getResults?page=`
      const { data: result } = await axios.get(url + page)
      this.feedbacks = result
    }
  },
  mounted() {
    this.$root.currentPage = this.$route.meta.name
    this.getResults()
  }
}
</script>

<style lang="scss" scoped></style>
