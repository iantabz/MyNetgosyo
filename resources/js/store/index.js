// THE CENTRAL STORE

import Vue from 'vue'
import Vuex from 'vuex'

import modules from './modules'

Vue.use(Vuex);
const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
  modules,
  state: {
    siteUrl: 'https://distribution.alturush.com/',
    // siteUrl: 'http://localhost:8001/',
     // kaloy 2021-10-18
     windowTitle: document.title,
  },

  strict: debug,
});