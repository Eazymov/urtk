<template lang="html">

  <footer id="footer">
    <p class="footer__text">2017 &copy;
      <a id="college-name" href="http://urtt.ru/">Уральский радиотехнический колледж им. А. С. Попова</a><br>
      Тел.: (343) 242-50-64, 242-50-82
    </p>

    <!-- Yandex.Metrika informer -->
    <a id="counter" href="https://metrika.yandex.ru/stat/?id=44062944&amp;from=informer"
    target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/44062944/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
    style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="44062944" data-lang="ru" /></a>
    <!-- /Yandex.Metrika informer -->
  </footer>

</template>

<script>
  export default { }
</script>

<style lang="sass">
  #footer
    box-shadow: 0 -1px 2px rgba(#000, .3)
    border-top: 1px solid #007bb8
    padding: 1rem 2% 1rem 7%
    background: #2196f3
    font-weight: 300
    line-height: 1.3
    min-height: 7vw
    color: white
    width: 100%
    float: left
    .footer__text
      display: inline-block
      letter-spacing: .5px
      max-width: 90%
      float: left
      #college-name
        border-bottom: 1px solid #fff
        text-decoration: none
        display: inline-block
        margin-bottom: .75rem
        transition: .25s
        color: white
        @media (max-width: 630px)
          text-decoration: underline
          margin-bottom: .5rem
          border: none
          height: auto
        &:hover
          border-color: transparent
          text-decoration: none

    #counter
      display: inline-block
      margin-top: 15px
      float: right
      @media (max-width: 600px)
        clear: both
        float: left
</style>
