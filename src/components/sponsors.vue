<template lang="html">
  <section id="content">

    <h3>Спонсоры и партнеры олимпиады</h3>
    <div id="owl" class="owl-carousel owl-theme">
      <a v-for="sponsor in sponsors"
         class="carousel-item"
         target="_blank"
         :class="{ disabled: !sponsor.link }"
         :href="sponsor.link ? sponsor.link : null"
         :title="sponsor.link ? 'Перейти по ссылке' : 'Ссылка отсутствует'">
        <img alt="Logo"
             class="carousel-item__logo"
             :src="`files/${sponsor.logo}`">
        <p class="carousel-item__title">{{ sponsor.title }}</p>
      </a>
    </div>

    <loader v-show="loading" />
  </section>
</template>

<script>
  import '../carousel.js';

  export default {
    data: () => ({
      sponsors: [],
      loading: false
    }),

    methods: {
      getData() {
        this.loading = true;

        this.$http
          .get('../../server_scripts/get/sponsors_list.php')
          .then(this.handleDataLoad)
          .catch(error => console.log(error));
      },

      handleDataLoad(response) {
        this.loading = false;

        this.sponsors = response.data
      }
    },

    created() {
      this.getData();
    },

    updated() {
      this.$emit('updated');

      jQuery('.owl-carousel').owlCarousel({
        loop: true,
        nav: false,
        dots: true,
        dotsEach: true,
        dotData: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsive: {
          100 : { items: 1 },
          500 : { items: 2 },
          900 : { items: 3 },
          1100: { items: 4 },
          1300: { items: 5 }
        }
      });
    },
  }
</script>

<style lang="sass">
  #owl
    vertical-align: middle
    margin: 4.5rem auto 0
    text-align: center
    width: 100%
    & > *:not(.owl-dots)
      line-height: 130px
    .carousel-item
      vertical-align: middle
      text-decoration: none
      display: inline-block
      text-align: center
      font-size: .7rem
      &.disabled
        cursor: default
      &__logo
        vertical-align: middle
        line-height: 100px
        max-height: 100px
        margin: 0 auto
        border: none
        width: auto
      &__title
        line-height: .8rem
        margin-top: .5rem
        font-size: .7rem

    .owl-dots
      margin-top: 1.2rem
      .owl-dot
        position: relative
        text-align: center
        margin: 0 2px
        height: 24px
        width: 24px
        &::before
          border: 0 solid #555
          border-radius: 50%
          position: absolute
          transition: .2s
          left: 12px
          top: 12px
          content: ''
          height: 0
          width: 0
        span
          position: absolute
          height: 14px
          transition: .2s
          left: 5px
          width: 14px
          top: 5px
          margin: 0
        &.active
          span
            background: #1976d2
            height: 8px
            width: 8px
            left: 8px
            top: 8px
          &::before
            border: 1px solid #1976d2
            border-radius: 50%
            position: absolute
            left: 2px
            top: 2px
            height: 20px
            width: 20px
            content: ''
        &:hover span
          background: #666
</style>
