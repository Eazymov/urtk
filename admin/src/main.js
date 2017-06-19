import Vue from 'vue'
import App from './App.vue'
import Router from './Router.js'
import Axios from 'axios'
import VAxios from 'vue-axios'
import VueMaterial from 'vue-material'

import MaterialButton from './components/other/material-button.vue'
import GoogleLoader from './components/other/google-loader.vue'
import FilterBox from './components/other/filter-box.vue'
import NotFound from './components/other/not-found.vue'
import FloatSubmit from './components/other/float-submit-button.vue'
import Prompt from './components/other/prompt-box.vue'
import WarningBox from './components/other/warning-box.vue'

import tinyMceCfg from './tinymce.config.js';

Vue.use(VAxios, Axios);
Vue.use(VueMaterial);

Vue.material.registerTheme('default', {
  primary: {
    color: 'blue',
    hue: 500
  },
  accent: {
    color: 'blue',
    hue: 500
  },
  warn: 'red',
  background: 'white'
})

Vue.component('material-button', MaterialButton);
Vue.component('loader', GoogleLoader);
Vue.component('filter-box', FilterBox);
Vue.component('not-found', NotFound);
Vue.component('float-submit', FloatSubmit);
Vue.component('prompt', Prompt);
Vue.component('warning-box', WarningBox);

new Vue({
  el: '#App',
  router: Router,
  render: f => f(App),
  created() {
    this.tinyMceCfg = tinyMceCfg;
  }
});
