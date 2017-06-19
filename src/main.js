import Vue    from 'vue/dist/vue.common.js';
import App    from './App.vue';
import Router from './Router.js';
import Scroll from 'vue-scrollto';
import Axios  from 'axios';
import VAxios from 'vue-axios';

import './events.js';

import NotFound from './components/other/not-found.vue';
import GoogleLoader from './components/other/google-loader.vue';

Vue.use(Scroll);
Vue.use(VAxios, Axios);

Vue.component('not-found', NotFound);
Vue.component('loader', GoogleLoader);

new Vue({
  el: '#App',
  router: Router,
  render: f => f(App)
});
