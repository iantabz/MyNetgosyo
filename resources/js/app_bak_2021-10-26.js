/** @format */

require('./bootstrap')

import Vue from 'vue'

window.Vue = Vue
window.moment = require('moment')

import router from './router'
import VueHtmlToPaper from 'vue-html-to-paper'
import Breadcrumb from './components/Breadcrumb'
import requestCount from './components/Requestcount'
// kaloy 2021-10-06
import OngoingTransactionsPendingCount from './components/transactions/OngoingTransactionsPendingCount'

Vue.filter('numberFormat', number => new Intl.NumberFormat().format(number))
Vue.filter('formatDate', date => {
  if (!date) return ''
  return moment(date).format('MM/DD/YYYY, h:mm:ss a')
})
Vue.filter('formatDateNoTime', date => moment(date).format('MMMM Do YYYY'))
Vue.filter('onlyTime', date => moment(date).format('h:mm:ss a'))
Vue.filter('calendar', date => moment(date).calendar())
Vue.component('breadcrumb', Breadcrumb)
Vue.component('request-count', requestCount)
Vue.component('ongoing-transactions-pending-count', OngoingTransactionsPendingCount)

const app = new Vue({
  el: '#app',
  router,
  data: () => ({
    authUser: null,
    newRequest: null,
    adminAccess: 'https://distribution.alturush.com/',
    currentPage: 'Home',
    
    // kaloy 2021-10-07
    TransactionsVue: {
      ongoing_transactions_pending_count: null,
      advanced_orders_count: null,
    },
    
    // kaloy 2021-10-18
    windowTitle: null,
    
    // kaloy 2021-10-21
    currentPendingOrders: null,
    
  }),
  created() {
    this.authUser = JSON.parse(window.authUser)
    this.newRequest = window.newRequest
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
    currentPendingOrders(newVal) {
      if(newVal > 0) {
        const vm = this;
        let bodyText = `You have ${newVal} pending orders as of now!`;
        let opt = {
          tag: 'MNGPendingOrders',
          body: bodyText,
          requireInteraction: true,
          renotify: true,
        };
        if(document.hidden) {
          vm.showNotif('MyNETgosyo',opt);
        }
      }
    },
  },
  
  methods: {
    // kaloy 2021-10-07
    ongoingTransactionsPendingCount() {
      const vm = this
      axios.get(`${vm.adminAccess}transaction/get-ongoing-transactions-count`)
      .then(response => {
        vm.TransactionsVue.ongoing_transactions_pending_count = response.data
        vm.updateDocTitle(response.data)
        // kaloy 2021-10-21
        vm.currentPendingOrders = response.data;
      })
    },
    advancedOrdersCount() {
      const vm = this
      axios.get(`${vm.adminAccess}transaction/advanced-orders-count`)
      .then(response => {
        vm.TransactionsVue.advanced_orders_count = response.data
      })
    },
    // kaloy 2021-10-18
    updateDocTitle(toPrepend) {
      if(parseInt(toPrepend) > 0) {
        document.title = `(${toPrepend}) ${this.windowTitle}`
      } else {
        document.title = `${this.windowTitle}`
      }
    },
    
    // kaloy 2021-10-21
    showNotif(title, options) {
      const vm = this
      if (!('Notification' in window)) {
        console.log('Error:','Notification API not supported!');
        return;
      }
      try {
        let notification = new Notification(title, options);
        notification.onclick = function(event){
          event.preventDefault();
          window.focus();
          window.location.href = `${vm.adminAccess}transactions`;
        };
      } catch (err) {
        console.log('Notification API error: ' + err);
      }
    },
  },
  
  mounted() {
    // kaloy 2021-10-07
    const vm = this
    setInterval(function(){
      vm.ongoingTransactionsPendingCount()
      vm.advancedOrdersCount()
    },30000)
    
    // kaloy 2021-10-18
    this.windowTitle = document.title
    this.updateDocTitle(0)
    
    // kaloy 2021-10-22
    if (!('Notification' in window)) {
      console.log('Error:','Notification API not supported!');
      return;
    } else {
      if(Notification.permission !== 'granted') {
        Notification.requestPermission();
      }
    }
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
