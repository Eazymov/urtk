<template lang="html">

  <div id="search-box">
    <form class="search-box__form" @submit.prevent="handleSearch">
      <input class="search-box__form__text"
             type="text"
             autocomplete="off"
             v-model="searchWord"
             placeholder="Поиск..." />
      <input class="search-box__form__submit"
             type="submit"
             value="Найти" />
    </form>
  </div>

</template>

<script>
  export default {
    data: () => ({
      searchWord: ''
    }),

    methods: {
      handleSearch() {
        let word = this.searchWord;

        if (!word) return;

        this.searchWord = '';
        this.$router.push(`/search/${word}`);
      }
    }
  }
</script>

<style lang="sass">
  #search-box
    padding: 3.25rem 0 0 0
    position: relative
    float: left
    width: 35%
    @media (max-width: 760px)
      padding: .5rem 0 .7rem
      width: 100%

    .search-box__form
      margin: 0 auto
      position: relative
      min-width: 240px
      overflow: auto
      width: 55%
      @media (max-width: 760px)
        width: 240px
      &::before
        background-image: url('../../files/icons/search.png')
        background-repeat: no-repeat
        background-size: cover
        position: absolute
        height: 1.28rem
        width: 1.28rem
        top: .3rem
        opacity: .4
        content: ''
        left: 0
      &__text
        border: none
        border-top: 1px solid transparent
        border-bottom: 1px solid #1976d2
        line-height: calc(1.6rem - 2px)
        padding: 0 7px 0 1.625rem
        background-color: #fff
        letter-spacing: .5px
        font-family: inherit
        font-size: .9rem
        height: 1.68rem
        width: 75%
        float: left
        &:focus
          -webkit-tap-highlight-color: rgba(0, 0, 0, 0)
                  tap-highlight-color: rgba(0, 0, 0, 0)
          outline: none !important
        @media (max-width: 850px)
          width: 180px
      &__submit
        line-height: calc(1.6rem - 2px)
        border-radius: 2px 2px 2px 0
        border: 1px solid #1976d2
        text-align: center
        margin-left: -1px
        background: #fff
        font-size: 1rem
        transition: .2s
        cursor: pointer
        height: 1.68rem
        color: #01579B
        float: left
        width: 25%
        padding: 0
        &:hover
          background-color: #f9f9f9
</style>
