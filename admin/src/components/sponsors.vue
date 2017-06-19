<template lang="html">
  <section id="content">

    <div class="sponsors-block">

      <div class="sponsors-block__head">
        <span class="md-title">Спонсоры</span>
        <md-button class="md-icon-button md-fab md-mini add-btn"
                   @click.native="$emit('fileBoxBtnClick')">
          <md-icon>add</md-icon>
          <md-tooltip md-delay="200">Добавить спонсора</md-tooltip>
        </md-button>
      </div>

      <div class="sponsors-block__list">
        <md-card class="sponsors-block__list__item md-with-hover"
                 v-for="sponsor in sponsors"
                 :key="sponsor.logo">
          <md-button class="md-icon-button md-raised md-dense del-btn"
                     @click.native="deleteSponsor(sponsor.logo)">
            <md-icon>delete_forever</md-icon>
            <md-tooltip md-delay="200">Удалить</md-tooltip>
          </md-button>

          <div class="ripple-wrapper">
            <md-ink-ripple />
            <div class="inner">
              <img :src="`../files/${sponsor.logo}`"
                   :alt="sponsor.title"
                   class="sponsors-block__list__item__logo">
              <a :href="sponsor.link ? sponsor.link : null"
                 :class="{ 'disabled': !sponsor.link }"
                 target="_blank"
                 class="sponsors-block__list__item__title">
                 <md-tooltip md-delay="200">
                   {{ sponsor.link ? 'Перейти по ссылке' : 'Ссылка отсутствует' }}
                 </md-tooltip>
                {{ sponsor.title }}</a>
            </div>
          </div>
        </md-card>
      </div>

      <loader v-show="loading" class="sponsors-block__loader" />
    </div>

    <prompt ref="prompt"
            :callback="promptCallback"
            text="Вы действительно хотите удалить элемент?" />

  </section>
</template>

<script>
  export default {
    data: () => ({
      sponsors: [],
      loading: true,
      promptCallback: null
    }),

    methods: {
      getData() {
        const uniqueParam = (new Date()).getTime();

        this.$http
          .get(`../../../server_scripts/get/sponsors_list.php?${uniqueParam}`)
          .then(this.handleAjaxLoad)
          .catch(error => console.log(error));
      },

      handleAjaxLoad(response) {
        this.loading = false;

        const { data } = response

        if (!data.length) return;

        this.sponsors = data;
      },

      addSponsor(obj) {
        this.sponsors.push(obj);
      },

      deleteSponsor(logo) {
        this.promptCallback = () => {
          const sponsors = this.sponsors;
          const index = sponsors.findIndex(el => el.logo === logo);

          sponsors.splice(index, 1);

          this.$http
            .post(`../../../server_scripts/delete/sponsor.php`, { logo })
            .catch(error => console.log(error));
        }

        this.$refs.prompt.$children[0].open()
      }
    },

    beforeDestroy() {
      this.$root.$off('sponsor-add', this.addSponsor);
    },

    created() {
      this.getData();

      this.$root.$on('sponsor-add', this.addSponsor);
    }
  }
</script>

<style lang="sass">
#App
  .sponsors-block
    &__head
      margin-bottom: 24px
      .md-title
        line-height: 2.5rem
      .add-btn.md-button.md-fab.md-mini
        background-color: #4caf50
        position: relative
        transition: .2s
        &:hover
          background-color: #4caf50

    &__list
      width: 850px
      &__item
        margin: 0 24px 24px 0
        display: inline-block
        text-align: center
        position: relative
        height: 150px
        width: 250px
        float: left
        .del-btn.md-button
          position: absolute
          background: #bbb
          transition: .3s
          right: -15px
          color: #fff
          z-index: 2
          top: -9px
          &:hover,
          &:focus
            transform: rotateZ(-25deg)
            background-color: #f44336

        .ripple-wrapper
          color: rgba(#000, .54)
          line-height: 130px
          position: relative
          padding: 10px

        .inner
          vertical-align: middle
          display: inline-block
          line-height: 1

        &__logo
          margin: 0 auto 10px
          max-height: 100px
          max-width: 180px
          display: block
          width: auto
        &__title
          text-overflow: ellipsis
          color: rgba(#000, .54)
          display: inline-block
          line-height: 1.1rem
          white-space: nowrap
          max-width: 230px
          font-weight: 400
          overflow: hidden
          font-size: .9rem
          &.disabled:hover
            text-decoration: none

    &__loader
      margin: 150px 0 0 325px
      width: 100px
</style>
