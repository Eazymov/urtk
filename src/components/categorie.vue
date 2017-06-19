<template lang="html">
  <section id="content">

    <h3>{{ categorie.title }}</h3>
    <section class="categorie-articles">
      <router-link class="categorie-articles__item"
                   v-for="article in categorie.articles"
                   :key="article.id"
                   :to="{ path: `/article/${article.id}` }">
        {{article.title}}
      </router-link>
    </section>
    <article class="categorie-content"
             v-html="categorie.content"
             id="db-output"></article>

    <not-found v-show="notFound" />

    <loader v-show="loading" />
  </section>
</template>

<script>
  const isIE = navigator.appName == 'Microsoft Internet Explorer' ||
               (navigator.userAgent.match(/Trident/) ||
               navigator.userAgent.match(/rv:11/));

  export default {
    data: () => ({
      categorie: {},
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
          .get(`../../server_scripts/get/categorie_content.php?id=${encodeURI(id)}`)
          .then(this.handleDataLoad)
          .catch(error => console.log(error));
      },

      handleDataLoad(response) {
        this.loading = false;

        const data = response.data;

        if (data) {
          this.notFound = false;
          this.categorie = data;
        } else {
          this.notFound = true;
          this.categorie = {};
        }

        !isIE && this.scrollIntoView();
      },

      scrollIntoView() {
        const opts = {
          container: this.$parent.$refs.pageScrollBox,
          offset: -25
        };

        try {
          this.$scrollTo(this.$el, 350, opts);

        } catch (error) {
          console.error(error.description);

        } finally {
          this.$el.scrollIntoView();
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
        this.categorie = {};

        this.getData();
      }
    }
  }
</script>

<style lang="sass">
  #content
    .categorie-articles
      margin-bottom: .625rem
      float: left
      clear: both
      &__item
        text-decoration: underline
        transition: .25s
        margin: .3rem 0
        display: block
        color: #111
        float: left
        clear: both
        &:hover,
        &:focus
          text-decoration: none

    .categorie-content
      float: left
</style>
