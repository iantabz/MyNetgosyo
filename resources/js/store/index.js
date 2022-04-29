// THE CENTRAL STORE

import Vue from 'vue'
import Vuex from 'vuex'

import modules from './modules'

Vue.use(Vuex);
const debug = process.env.NODE_ENV !== 'production';

// kaloy 2022-04-22
const host = window.location.protocol + '//' + window.location.host + '/';

export default new Vuex.Store({
  modules,
  state: {
    // siteUrl: 'https://distribution.alturush.com/',
    siteUrl: host,
     // kaloy 2021-10-18
     windowTitle: document.title,
  },

  strict: debug,
});