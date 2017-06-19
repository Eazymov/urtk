<template lang="html">
  <section id="content">

    <h3 v-show="notFound">По запросу «{{ searchWord }}» ничего не найдено</h3>
    <div v-show="results.length">
      <h3>Результаты по запросу «{{ searchWord }}» ({{ results.length }})</h3>
      <div v-for="item in results" class="search-item">
        <router-link class="search-item__link"
                     :to="{ path: `/${item.obj}/${item.id}`}">
          {{ item.title }}
        </router-link>
        <br />
        <time class="search-item__date">{{ item.date }}</time>
      </div>
    </div>

    <loader v-show="loading" />
  </section>
</template>

<script>
  const isIE = navigator.appName == 'Microsoft Internet Explorer' ||
               (navigator.userAgent.match(/Trident/) ||
               navigator.userAgent.match(/rv:11/));

  export default {

    data: () => ({
      results: [],
      notFound: false
    }),

    computed: {
      searchWord() {
        return this.$route.params.word;
      }
    },

    methods: {
      getData() {
        const word = encodeURI(this.searchWord);

        this.loading = true;

        this.$http
          .get(`../../server_scripts/get/search.php?word=${word}`)
          .then(this.handleDataLoad)
          .catch(error => console.log(error));
      },

      handleDataLoad(response) {
        this.loading = false;

        const data = response.data;

        this.notFound = !data.length;
        this.results = data;

        !isIE && this.scrollIntoView();
      },

      scrollIntoView() {
        const opts = {
          container: this.$parent.$refs.pageScrollBox,
          offset: -25
        }

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

    beforeDestroy() {
      this.$parent.searchWord = '';
    },

    watch: {
      $route(oldValue, newValue) {
        this.notFound = false;
        this.results = [];

        const oldParam = oldValue.params.word;
        const newParam = newValue.params.word;

        (newParam !== oldParam) && this.getData();
      }
    }
  }
</script>

<style lang="sass">
  #content
    .search-item
      &__link
        text-decoration: none
        display: inline-block
        font-size: 1.1rem
        font-weight: 400
        color: #0D47A1
        &:hover
          text-decoration: underline
      &__date
        color: rgba(0, 0, 0, .54)
        display: inline-block
        margin-bottom: .7rem
        font-size: .75rem
        font-weight: 500
</style>
