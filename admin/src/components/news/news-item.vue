<template lang="html">
  <section id="content">

    <div v-if="news">
      <article v-html="news.content" id="db-output"></article>
      <time pubdate id="date">Дата: {{ formatDate(news.date) }}</time>
    </div>

    <not-found v-if="notFound" />

    <loader v-show="loading" />

  </section>
</template>

<script>
  export default {
    data: () => ({
      news: null,
      notFound: false,
      loading: false
    }),

    methods: {
      getData() {
        const id = +this.$route.params.id;

        if (!id) {
          this.notFound = true;
          return;
        }

        this.loading = true;

        const uniqueParam = (new Date()).getTime();

        this.$http
          .get(`../../../../server_scripts/get/news_content.php?id=${id}&${uniqueParam}`)
          .then(this.handleDataLoad)
      },

      handleDataLoad(response) {
        this.loading = false;

        const { data } = response;

        if (data) {
          this.notFound = false;
          this.news = response.data;
        } else {
          this.notFound = true;
          this.news = null;
        }
      },

      formatDate(date) {
        const parts = date.split('-');

        return `${parts[2]}-${parts[1]}-${parts[0]}`;
      }
    },

    created() {
      this.getData();
    },

    watch: {
      $route() {
        this.news = null;

        this.notFound = false;

        this.getData();
      }
    }
  }
</script>
