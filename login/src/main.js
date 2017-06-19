import Vue    from 'vue'
import App    from './App.vue'
import Axios  from 'axios'
import VAxios from 'vue-axios'

import MaterialButton  from './components/material-button.vue'
import GoogleLoader from './components/google-loader.vue'

Vue.use(VAxios, Axios)

Vue.component('material-button', MaterialButton)
Vue.component('loader', GoogleLoader)

new Vue({
  el: '#App',

  render: f => f(App)
})
