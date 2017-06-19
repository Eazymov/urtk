<template lang="html">
  <section id="content">

    <div class="news-list">

      <div class="news-list__head">
        <span class="md-title">Новости</span>
        <md-button href="#/news/create"
                   class="md-icon-button md-fab md-mini add-btn">
          <md-icon>add</md-icon>
          <md-tooltip md-delay="500">Добавить новость</md-tooltip>
        </md-button>

        <filter-box :options="columns"
                    class="news-list__head__filter-box"
                    @queryChange="$val => filterQuery = $val"
                    @filterChange="$val => filter = $val" />
      </div>

      <md-whiteframe md-elevation="2" md-tag="table" class="news-list__table">
        <thead>
          <tr>
            <th v-for="(value, key) in columns"
                :key="key"
                :class="[value, { 'sorted': sort === value }]"
                @click="setSort(value)">
              <md-icon class="md-18">
                {{ reversed ? 'arrow_downward' : 'arrow_upward' }}
              </md-icon>
              {{key}}
              <md-tooltip md-delay="500">Сортировать</md-tooltip>
            </th>
            <th class="actions" colspan="2"></th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="item in filteredNews">
            <td class="id">{{ item.id }}</td>
            <td class="date">
              <router-link :to="{ path: `news/${item.id}` }">
                {{ formatDate(item.date) }}
                <md-tooltip md-delay="500">Посмотреть содержание</md-tooltip>
              </router-link>
            </td>
            <td class="title">
              <router-link :to="{ path: `news/${item.id}` }">
                {{ item.title }}
                <md-tooltip md-delay="500">Посмотреть содержание</md-tooltip>
              </router-link>
            </td>
            <td class="actions">
              <md-button :href="`#/news/${item.id}/edit`"
                         class="md-icon-button md-dense edit-btn">
                <md-icon>edit</md-icon>
                <md-tooltip md-delay="500">Редактировать</md-tooltip>
              </md-button>
            </td>
            <td class="actions">
              <md-button class="md-icon-button md-dense del-btn"
                         @click.native="deleteNews(item.id)">
                <md-icon>delete_forever</md-icon>
                <md-tooltip md-delay="500">Удалить</md-tooltip>
              </md-button>
            </td>
          </tr>
        </tbody>
      </md-whiteframe>
    </div>

    <prompt ref="prompt"
            :callback="promptCallback"
            text="Вы действительно хотите удалить новость?" />

    <loader v-show="loading" class="news-list__loader" />
  </section>
</template>

<script>
  export default {
    data: () => ({
      news: [],
      sort: 'date',
      filter: 'title',
      filterQuery: '',
      reversed: false,
      columns: {
        'id': 'id',
        'Дата': 'date',
        'Заголовок': 'title'
      },
      loading: true,
      promptCallback: null
    }),

    computed: {
      filteredNews() {
        const filter = this.filter;
        const query = this.filterQuery.toLowerCase();
        const news = this.sortedNews;

        if (query)
          return news
            .filter(el => {
              const elem = (filter === 'date') ? this.formatDate(el[filter]) : el[filter];

              return elem.toLowerCase().includes(query);
            })

        return news;
      },

      sortedNews() {
        const sort = this.sort;

        return this.news.sort((a, b) => {
          let prev = +a[sort] || a[sort];
          let next = +b[sort] || b[sort];

          if (this.reversed) {
            [prev, next] = [next, prev];
          }

          return prev < next ? 1 : -1;
        })
      }
    },

    methods: {
      formatDate(date) {
        const parts = date.split('-');

        return `${parts[2]}-${parts[1]}-${parts[0]}`;
      },

      getData() {
        const uniqueParam = (new Date()).getTime();

        this.$http
          .get(`../../../../server_scripts/get/news_list.php?${uniqueParam}`)
          .then(this.handleDataLoad)
      },

      handleDataLoad(response) {
        this.loading = false;

        const { data } = response

        if (!data.length) return;

        this.news = data
      },

      setSort(sort) {
        const reversed = this.reversed;

        this.reversed = (this.sort === sort) ? !reversed : reversed;

        this.sort = sort;
      },

      resetFilter() {
        this.filterWord = '';

        this.filterIsActive = false;
      },

      deleteNews(id) {
        this.promptCallback = () => {
          const news = this.news;
          const index = news.findIndex(el => el.id === id);

          news.splice(index, 1);

          this.$http
            .post(`../../../../server_scripts/delete/news.php`, {id: id});
        }

        this.$refs.prompt.$children[0].open()
      }
    },

    created() {
      this.getData();
    }
  }
</script>

<style lang="sass">
#content
  .news-list
    &__head
      padding-bottom: 16px
      position: relative
      width: 850px
      color: #fff
      &::after
        display: table
        content: ''
        clear: both
      .md-title
        color: rgba(#000, .87)
        line-height: 2.5rem
      .add-btn.md-button.md-fab.md-mini
        background-color: #4caf50
        position: relative
        transition: .2s
        &:hover
          background-color: #4caf50

      &__filter-box
        position: absolute
        bottom: 10px
        right: 0

    &__table
      border-collapse: collapse
      background-color: #fff
      text-align: center
      width: 850px

      thead
        border-bottom: 1px solid #ccc
        color: rgba(#000, .54)
        line-height: 36px
        th
          font-size: .85rem
          font-weight: 500
          cursor: pointer
          height: 54px
          &.sorted
            color: rgba(#000, .87)
            .md-icon
              display: inline-block
          .md-icon
            display: none
            width: 18px
            height: 18px

          &.id
            width: 58px
          &.date
            width: 122px
          &.title
            width: 576px
          &.actions
            width: 94px

      tbody
        tr
          border-top: 1px solid #ccc
          color: rgba(#000, .87)
          transition: .2s
          &:hover
            background-color: #eee
        td
          font-size: .9125rem
          font-weight: 400
          padding: 0 20px
          height: 47px
          a
            color: inherit
        .id
          padding: 0
        .date
          text-decoration: underline
        .title
          text-overflow: ellipsis
          white-space: nowrap
          max-width: 576px
          overflow: hidden
          text-align: left
          a:hover
            text-decoration: underline
        .actions
          color: rgba(#000, .54)
          padding: 7px 1px
          &:hover,
          &:focus
            color: rgba(#000, .87)
          a
            color: rgba(#000, .54)

    &__loader
      margin: 50px 0 0 375px
      width: 100px
</style>
