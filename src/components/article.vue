<template lang="html">
  <div id="content">

    <article v-html="article.content" id="db-output">{{ article.content }}</article>
    <time pubdate v-if="article.date" id="date">Дата: {{ formatDate(article.date) }}</time>

    <not-found v-show="notFound" />

    <loader v-show="loading" />
  </div>
</template>

<script>
  export default {
    data: () => ({
      article: {},
      loading: false,
      notFound: false
    }),

    methods: {
      getData() {
        const id = +this.$route.params.id;

        if (!id) {
          this.notFound = true;
          return;
        }

        this.loading = true;

        this.$http
          .get(`../../server_scripts/get/article_content.php?id=${encodeURI(id)}`)
          .then(this.handleDataLoad)
          .catch(error => console.log(error));
      },

      handleDataLoad(response) {
        this.loading = false;

        const data = response.data;

        if (data) {
          this.notFound = false;
          this.article = data;
        } else {
          this.notFound = true;
          this.article = {};
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

    updated() {
      this.$emit('updated');
    },

    watch: {
      $route() {
        this.article = {};
        this.notFound = false;

        this.getData();
      }
    }
  }
</script>
