<template lang="html">

  <div id="top-panel">
    <p class="top-panel__text" v-html="panelText"></p>
    <img class="top-panel__logo" src="files/top-panel-logo.png" alt="logo">
  </div>

</template>

<script>
  export default {
    props: {
      panelText: {
        type: String,
        default: ''
      }
    }
  }
</script>

<style lang="sass">
  #top-panel
    box-shadow: 0 1px 2px rgba(#000, .3)
    margin-bottom: 15px
    background: #E74B0E
    position: relative
    min-height: 130px
    font-weight: 300
    width: 100%
    float: left
    .top-panel__logo
      height: auto !important
      position: absolute
      margin-top: .25%
      max-width: 410px
      min-width: 330px
      width: 25%
      right: 0
      @media (max-width: 760px)
        display: none
    .top-panel__text
      padding: 1% 1.2% 1% 5%
      letter-spacing: 1.1px
      font-size: 1.2rem
      display: block
      color: #fff
      float: left
      width: 80%
      @media (max-width: 1200px)
        width: 75%
      @media (max-width: 850px)
        width: 70%
      @media (max-width: 760px)
        font-size: 1rem
        width: 100%
</style>
