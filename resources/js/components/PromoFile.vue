<!-- @format -->

<template>
  <div id="page-content">
    <div class="row">
      <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
        <div class="row pricing pricing-no-gutter-sm">
          <!--Personal Plan-->
          <!--===================================================-->
          <div class="col-sm-4">
            <div class="panel">
              <div class="panel-body">
                <p class="pricing-title">Personal</p>
                <p class="pricing-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                <div class="pricing-price">
                  <p>
                    <span class="text-semibold text-primary">$19</span>
                  </p>
                  <p>Monthly</p>
                </div>
                <ul class="pricing-list">
                  <li>
                    <strong>5</strong> Projects
                  </li>
                  <li>
                    <strong>10</strong> GB Storage
                  </li>
                  <li>
                    <strong>1</strong> User
                  </li>
                  <li>
                    <strong>Free</strong> Support
                  </li>
                </ul>
                <button class="btn btn-block btn-primary btn-lg">Choose</button>
              </div>
            </div>
          </div>
          <!--===================================================-->

          <!--Premium Plan-->
          <!--===================================================-->
          <div class="col-sm-4 pricing-featured">
            <div class="panel">
              <div class="ribbon">
                <span>POPULAR</span>
              </div>
              <div class="panel-body">
                <p class="pricing-title">Premium</p>
                <p class="pricing-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                <div class="pricing-price">
                  <p>
                    <span class="text-semibold text-success">$39</span>
                  </p>
                  <p>Monthly</p>
                </div>
                <ul class="pricing-list">
                  <li>
                    <strong>20</strong> Projects
                  </li>
                  <li>
                    <strong>100</strong> GB Storage
                  </li>
                  <li>
                    <strong>50</strong> Users
                  </li>
                  <li>
                    <strong>Free</strong> Support
                  </li>
                </ul>
                <button class="btn btn-block btn-success btn-lg">Choose</button>
              </div>
            </div>
          </div>

          <!--Enterprise Plan-->
          <!--===================================================-->
          <div class="col-sm-4">
            <div class="panel">
              <div class="panel-body">
                <p class="pricing-title">Enterprise</p>
                <p class="pricing-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
                <div class="pricing-price">
                  <p>
                    <span class="text-semibold text-purple">$99</span>
                  </p>
                  <p>Monthly</p>
                </div>
                <ul class="pricing-list">
                  <li>
                    <strong>Unlimited</strong> Projects
                  </li>
                  <li>
                    <strong>Unlimited</strong> GB Storage
                  </li>
                  <li>
                    <strong>Unlimited</strong> Users
                  </li>
                  <li>
                    <strong>Free</strong> Support
                  </li>
                </ul>
                <button class="btn btn-block btn-purple btn-lg">Choose</button>
              </div>
            </div>
          </div>
          <!--===================================================-->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    console.log("Component mounted.");
    this.$root.currentPage = this.$route.meta.name;
  },
};
</script>
