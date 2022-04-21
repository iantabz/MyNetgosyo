/** @format */

require('./bootstrap')

import Vue from 'vue'

window.Vue = Vue
window.moment = require('moment')

import router from './router'
import VueHtmlToPaper from 'vue-html-to-paper'
import Breadcrumb from './components/Breadcrumb'
import requestCount from './components/Requestcount'
import OngoingTransactionsPendingCount from './components/transactions/OngoingTransactionsPendingCount'

// kaloy 2021-10-25
import store from './store'
import { mapActions, mapGetters, mapState } from 'vuex'
import { showNotif } from './utils/helpers'

Vue.filter('numberFormat', number => new Intl.NumberFormat().format(number))
Vue.filter('formatDate', date => moment(date).format('MMMM Do YYYY, h:mm:ss a'))
Vue.filter('formatDateNoTime', date => moment(date).format('MMMM Do YYYY'))
Vue.filter('onlyTime', date => moment(date).format('h:mm:ss a'))
Vue.component('breadcrumb', Breadcrumb)
Vue.component('request-count', requestCount)
Vue.component('ongoing-transactions-pending-count', OngoingTransactionsPendingCount)

// kaloy 2022-04-18
Vue.filter("toCurrency", function (value) {
  if (typeof value !== "number") {
    return value;
  }
  var formatter = new Intl.NumberFormat("en-PH", {
    style: "currency",
    currency: "PHP",
    minimumFractionDigits: 2,
  });
  const formatted = formatter.format(value);
  return formatted.replace('₱','').replace('Php','');
});


// // kaloy 2021-10-26
// import Modal from './components/Modal.vue'
// Vue.component('modal', Modal)

// import Spinner from './components/Spinner.vue'
// Vue.component('spinner', Spinner)


// kaloy 2021-11-05
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
const files = require.context('./components/globals/', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


const app = new Vue({
  el: '#app',
  router,
  store,
  data: () => ({
    authUser: null,
    newRequest: null,
    adminAccess: 'https://distribution.alturush.com/',
    // adminAccess: 'http://localhost:8001/',
    currentPage: 'Home',
  }),

  computed: {
    ...mapGetters('transactions', [
      'getOngoingPendingCount'
    ]),
    ...mapState([
      'siteUrl',
      'windowTitle'
    ])
  },

  methods: {
    ...mapActions('transactions',[
      'ongoingPendingCount',
      'advancedOrdersCount',
    ]),

  },

  watch: {
    currentPage(val) {
      if (val == 'Order History' || val == 'Sales Report')
        $('#container')
          .removeClass('mainnav-lg')
          .addClass('mainnav-sm')
      else {
        $('#container')
          .removeClass('mainnav-sm')
          .addClass('mainnav-lg')
      }
    },

    // kaloy 2021-10-21
    getOngoingPendingCount(newVal) {
      // include pending count in the document title
      if(parseInt(newVal) > 0) {
        document.title = `(${newVal}) ${this.windowTitle}`;
      } else {
        document.title = `${this.windowTitle}`;
      }

      if(newVal > 0) {
        let bodyText = `You have ${newVal} pending orders as of now!`;
        let opt = {
          tag: 'MNGPendingOrders',
          body: bodyText,
          requireInteraction: true,
          renotify: true,
        };
        if(document.hidden) {
          showNotif('My NETgosyo',opt,this.siteUrl);
        }
      }
    },

  },
  
  created() {
    // kaloy 2021-10-25
    this.ongoingPendingCount()
    this.advancedOrdersCount()
  },

  mounted() {
    this.authUser = JSON.parse(window.authUser)
    this.newRequest = window.newRequest

    // kaloy 2021-10-07
    // check repeatedly if there is an ongoing pending transaction
    // for a 30 sec interval. (short polling)
    const vm = this
    setInterval(function(){
      vm.ongoingPendingCount()
      vm.advancedOrdersCount()
    }, 30000)

  },

})

const options = {
  name: '_blank',
  specs: ['fullscreen=yes', 'titlebar=yes', 'scrollbars=yes'],
  styles: [
    'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
    'https://unpkg.com/kidlat-css/css/kidlat.css'
  ]
}

Vue.use(VueHtmlToPaper, options)

// or, using the defaults with no stylesheet
Vue.use(VueHtmlToPaper)
