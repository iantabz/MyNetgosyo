/** @format */

window._ = require('lodash')

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  // window.Popper = require('popper.js').default;
  // window.$ = window.jQuery = require("jquery");
  // require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

const axios = require('axios')

axios.interceptors.response.use(
  response => response,
  error => {
    if (error.response.status === 401 || error.response.status === 419) {
      // showAlert({
      //   icon: 'info',
      //   title: 'Information',
      //   text:
      //     'Session expired, the system will redirect you to login page in a few seconds',
      //   timer: 3500
      // })
      alert(
        'Session expired, the system will redirect you to login page in a few seconds'
      )
      setTimeout(() => {
        location.assign('/login')
      }, 3500)
    } else if (error.response.status >= 500) {
      // showAlert({
      //   icon: 'error',
      //   title: 'Unexpected Error Occured',
      //   text:
      //     'An error has encountered, please contact 1844 and specify how it happened',
      //   timer: 120000
      // })
      alert(
        'An error has encountered, please contact 1844 and specify how it happened'
      )
    }

    return Promise.reject(error)
  }
)

window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

let authUser = document.head.querySelector('meta[name="auth-user"]')

const auth = JSON.parse(authUser.content)

if (auth.type === 'Admin') {
  const newRequests = parseInt(
    document.getElementById('new_requests').innerHTML.trim()
  )

  window.newRequests = newRequests
}

window.authUser = authUser.content

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
