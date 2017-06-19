<template lang="html">
  <ul id="menu">

    <li>
      <router-link class="menu__item"
                   :to="{ path: '/' }"
                   :style="{ width: menuItemWidth }"
                   exact>Спонсоры</router-link>
    </li>
    <li>
      <router-link class="menu__item"
                   v-for="categorie in categories"
                   :key="categorie.id"
                   :style="{ width: menuItemWidth }"
                   :to="{ path: '/categorie/' + categorie.id }">
        {{ categorie.title }}
      </router-link>
    </li>

  </ul>
</template>

<script>
  export default {
    data: () => ({
      categories: [],
      menuItemWidth: 0
    }),

    updated() {
      const menuLength = this.categories.length + 1;

      this.menuItemWidth = 100 / menuLength + '%';
    },

    beforeCreate() {
      this.$http
        .get('../../server_scripts/get/categories_list.php')
        .then(response => this.categories = response.data
          .filter(el => +el.visible))
        .catch(error => console.log(error));
    }
  }
</script>

<style lang="sass">
  $blue: #1976d2
  $lightBlue: #2196f3

  #menu
    background: $lightBlue
    transition: opacity .2s
    font-weight: 300
    list-style: none
    width: 100%
    float: left
    z-index: 10
    &.fixed
      width: calc(100% - 6px)
      position: fixed
      opacity: .3
      top: 0
      &:hover
        opacity: 1
    .menu__item
      border-bottom: 1px solid $blue
      transition: background .2s
      text-transform: uppercase
      text-overflow: ellipsis
      text-decoration: none
      display: inline-block
      white-space: nowrap
      letter-spacing: 2px
      position: relative
      text-align: center
      overflow: hidden
      font-size: .8rem
      padding: 3px 5px
      cursor: pointer
      color: white
      float: left
      &:hover,
      &.active
        font-weight: 400
        background: #fff
        color: $blue
      @media (max-width: 1000px)
        letter-spacing: .5px
      @media (max-width: 805px)
        letter-spacing: 1px
      @media (max-width: 630px)
        width: 100% !important
        letter-spacing: 2px
        display: block
</style>
