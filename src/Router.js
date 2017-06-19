import Vue    from 'vue/dist/vue.common.js';
import Router from 'vue-router';

import Sponsors  from './components/sponsors.vue';
import NewsList  from './components/news-list.vue';
import NewsItem  from './components/news-item.vue';
import Categorie from './components/categorie.vue';
import Article   from './components/article.vue';
import Search    from './components/search.vue';

Vue.use(Router);

export default new Router({
  linkActiveClass: 'active',

  saveScrollPosition: true,

  history: true,

  routes: [
    { path: '/', component: Sponsors },

    { path: '/news', component: NewsList },
    { path: '/news/:id', component: NewsItem },

    { path: '/categorie/:id', component: Categorie },
    { path: '/article/:id', component: Article },

    { path: '/search/:word', component: Search },

    { path: '*', redirect: '/' },
  ],
});
