<template lang="html">
  <section id="content">

    <article v-html="news.content" id="db-output"></article>
    <time pubdate v-if="news.date" id="date">Дата: {{ formatDate(news.date) }}</time>

    <not-found v-show="notFound" />

    <loader v-show="loading" />
  </section>
</template>

<script>
  export default {
    data: () => ({
      news: {},
      loading: false,
      notFound: false
    }),

    methods: {
      formatDate(date) {
        const parts = date.split('-');

        return `${parts[2]}-${parts[1]}-${parts[0]}`;
      },

      getData() {
        const id = +this.$route.params.id;

        if (!id) {
          this.notFound = true;
          return;
        }

        this.loading = true;

        this.$http
          .get(`../../server_scripts/get/news_content.php?id=${encodeURI(id)}`)
          .then(this.handleDataLoad)
          .catch(error => console.log(error));
      },

      handleDataLoad(response) {
        this.loading = false;

        const data = response.data;

        if (data) {
          this.notFound = false;
          this.news = data;
        } else {
          this.notFound = true;
          this.news = {};
        }
      }
    },

    created() {
      this.getData();
    },

    updated() {
      this.$emit('updated');
    },

    watch: {
      $route() {
        this.notFound = false;
        this.news = {};

        this.getData();
      }
    }
  }
</script>
