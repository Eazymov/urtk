<template lang="html">

  <div class="logo-section">
    <router-link to="/" class="logo-section__logo">
      <img src="files/logo.PNG" alt="Logo">
    </router-link>

    <div class="logo-section__text">
      <p class="logo-section__text__title">
        Всероссийская олимпиада профессионального мастерства
        <br />
        <span class="logo-section__text__stage">{{ stage }}</span>
      </p>
    </div>
  </div>

</template>

<script>
  export default {
    props: {
      stage: {
        type: String,
        default: ''
      }
    }
  }
</script>

<style lang="sass">
  .logo-section
    float: left
    width: 65%
    @media (max-width: 760px)
      padding: 0 5% 0 calc(50% - 230px)
      width: 100%
    @media (max-width: 530px)
      padding: 0

    &__logo
      padding: .625rem 1rem
      width: 8.37rem
      float: left
      @media (max-width: 530px)
        margin: 0 calc(50% - 65px)
        min-width: 130px
        display: block
      img
        height: auto !important
        width: 100%
        float: left

    &__text
      max-width: calc(100% - 8.37rem)
      padding-top: 1.5rem
      float: left
      @media (max-width: 530px)
        text-align: center
        max-width: 100%
        padding: 0 5%
        width: 100%
        clear: both
      &__title
        font-size: 1.3rem
        font-weight: 400
        color: #096d9c
      &__stage
        color: rgba(#000, .54)
        display: inline-block
        margin-top: .5rem
        font-weight: 500
        width: 100%
</style>
