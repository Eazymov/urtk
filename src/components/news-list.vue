<template lang="html">
  <section id="content">

    <div class="news-list">
      <h3 class="news-list__title">Все новости:</h3>

      <div class="news-list__item" v-for="item in news">
        <router-link class="news-list__item__date"
                     :to="{ path: `/news/${item.id}` }">
          {{ formatDate(item.date) }}
        </router-link>
        <p class="news-list__item__title">{{ item.title }}</p>
      </div>
    </div>

    <loader v-show="loading" />
  </section>
</template>

<script>
  export default {
    data: ()=> ({
      news: [],
      loading: false
    }),

    methods: {
      formatDate(date) {
        const parts = date.split('-');

        return `${parts[2]}-${parts[1]}-${parts[0]}`;
      },

      getData() {
        this.loading = true;

        this.$http
          .get('../../server_scripts/get/news_list.php')
          .then(this.handleDataLoad)
          .catch(error => console.log(error));
      },

      handleDataLoad(response) {
        this.loading = false;

        this.news = response.data
      }
    },

    updated() {
      this.$emit('updated');
    },

    created() {
      this.getData();
    }
  }
</script>

<style lang="sass">
  .news-list
    &__title
      margin-bottom: 1.9rem
      font-size: 1.25rem
      font-weight: 500
    &__item
      margin-bottom: .6rem
      &__date
        display: inline-block
        margin-bottom: .2rem
        color: #BF360C
</style>
