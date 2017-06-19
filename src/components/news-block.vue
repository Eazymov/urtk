<template lang="html">
  <aside id="news-block">

    <h3>Новости</h3>
    <div class="news-block__item"
         v-for="(item, index) in news"
         v-if="index < 3">
      <router-link class="news-block__item__date"
                   :to="{ path: '/news/' + item.id }">
        {{ formatDate(item.date) }}
      </router-link>
      <p class="news-block__item__title">{{ item.title }}</p>
    </div>
    <router-link id="all-news-btn"
                 :to="{ path: '/news/' }"
                 v-if="news[0]">Все новости
    </router-link>

  </aside>
</template>

<script>
  export default {
    data: () => ({
      news: []
    }),

    methods: {
      formatDate(date) {
        const parts = date.split('-');

        return `${parts[2]}-${parts[1]}-${parts[0]}`;
      }
    },

    updated() {
      this.$emit('updated');
    },

    beforeCreate() {
      this.$http
        .get('../../server_scripts/get/news_list.php')
        .then(response => this.news = response.data)
        .catch(error => console.log(error));
    }
  }
</script>

<style lang="sass">
  #news-block
    padding: 0 1.5% 0 1.5%
    overflow: hidden
    float: left
    width: 25%
    @media (max-width: 950px)
      width: 35%
    @media (max-width: 760px)
      border-bottom: 2px solid #d2d2d2
      margin-bottom: 9px
      min-height: 130px
      width: 100%
    h3
      margin-bottom: .8rem
      font-size: 1.25rem
      font-weight: 500
      @media (max-width: 760px)
        padding: 0 !important
        text-align: center
        width: 100%

    .news-block__item
      box-shadow: 0 1px 2px rgba(#000, .3)
      padding: 0 .5rem .3rem .5rem
      border-radius: 0 0 2px 2px
      border: 1px solid #bbb
      margin: 0 auto .7rem
      max-width: 500px
      border-top: none
      transition: .25s
      &__date
        display: inline-block
        margin-bottom: .4rem
        color: #BF360C
        &:hover
          text-decoration: none

  #all-news-btn
    margin-bottom: .6rem
    text-align: center
    font-size: .87rem
    font-weight: 400
    color: #BF360C
    display: block
    width: 100%
</style>
