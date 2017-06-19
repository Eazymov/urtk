<template lang="html">

  <div id="scroll-buttons">
    <div id="scroll-to-top-btn"></div>
    <div id="scroll-to-bot-btn"></div>
  </div>

</template>

<script>
  export default { }
</script>

<style lang="sass">
  #scroll-buttons
    transition-timing-function: ease-out, step-end, step-end
    border-radius: 0 2px 2px 0
    top: calc(50vh - 40px)
    visibility: hidden
    overflow: hidden
    transition: .25s
    position: fixed
    height: 80px
    width: 40px
    color: #fff
    opacity: 0
    z-index: 5
    &.active
      visibility: visible
      opacity: .5
    &:hover
      opacity: 1
    #scroll-to-top-btn,
    #scroll-to-bot-btn
      background-position: 8px 8px
      background-repeat: no-repeat
      background-size: 24px 24px
      background-color: #2196f3
      text-align: center
      line-height: 38px
      transition: .15s
      cursor: pointer
      height: 40px
      width: 40px
      opacity: .5
      &:hover
        opacity: 1
    #scroll-to-top-btn
      background-image: url('../../files/icons/move-up-white.png')
    #scroll-to-bot-btn
      background-image: url('../../files/icons/move-down-white.png')
</style>
