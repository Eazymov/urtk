<template>
  <div id="App">

    <div id="page-scrollBar" ref="pageScrollBar">
      <span id="page-scroller"
            @mousedown.stop.prevent="startScroll($event, pageScrollBox)">
      </span>
    </div>

    <div id="page-scrollBox" ref="pageScrollBox" @scroll="updateScrollBar">
      <div id="page-content" ref="pageContent">
        <scroll-buttons ></scroll-buttons>

        <header id="header">
          <logo-section :stage="homepage.stage" ></logo-section>
          <search-box ></search-box>
        </header>

        <div id="wrapper">
          <navigation ></navigation>

          <top-panel :panelText="homepage.panelText" ></top-panel>

          <div id="page-body">
            <news-block @updated="updateScrollBar" ></news-block>
            <router-view @updated="updateScrollBar" id="content" ></router-view>
          </div>
        </div>

        <app-footer ></app-footer>
      </div>
    </div>

  </div>
</template>

<script>
  import ScrollButtons from './components/scroll-buttons.vue';
  import LogoSection from './components/logo-section.vue';
  import SearchBox from './components/search-box.vue';
  import Navigation from './components/navigation.vue';
  import TopPanel from './components/top-panel.vue';
  import NewsBlock  from './components/news-block.vue';
  import Footer from './components/footer.vue';

  export default {
    components: {
      'scroll-buttons': ScrollButtons,
      'logo-section': LogoSection,
      'search-box': SearchBox,
      'navigation': Navigation,
      'top-panel': TopPanel,
      'news-block': NewsBlock,
      'app-footer': Footer
    },

    data: () => ({
      homepage: {}
    }),

    computed: {
      pageScrollBar() {
        return this.$refs.pageScrollBar;
      },
      pageScrollBox() {
        return this.$refs.pageScrollBox;
      },
      pageContent() {
        return this.$refs.pageContent;
      }
    },

    methods: {
      updateScrollBar() {
        const page        = this.pageContent;
        const scrollBar   = this.pageScrollBar;
        const scrollBox   = this.pageScrollBox;
        const scroller    = scrollBar.firstElementChild;
        const scrollBoxH  = scrollBox.offsetHeight;
        const content     = scrollBox.firstElementChild;
        const contentH    = content.offsetHeight;
        const scrolled    = scrollBox.scrollTop;
        const scrollerH   = scrollBoxH / contentH * scrollBoxH;
        const scrollRange = contentH - scrollBoxH;
        const scrollTo    = (scrolled / scrollRange) * (scrollBoxH - scrollerH);

        let shouldShowScrollBar = contentH > scrollBoxH;

        scrollBar.style.display = shouldShowScrollBar ? 'block' : 'none';
        page.className = shouldShowScrollBar ? 'showScroll' : '';

        scroller.style.height = scrollerH + 'px';
        scroller.style.top    = scrollTo + 'px';
      },

      startScroll(e, box) {
        const scrollBox  = this.pageScrollBox;
        const scrollBoxH = scrollBox.offsetHeight;
        const content    = scrollBox.firstElementChild;
        const contentH   = content.offsetHeight;
        const coeff      = contentH / scrollBoxH;
        const target     = e.target;
        const targetTop  = (target.getBoundingClientRect()).top;
        const shiftY     = e.pageY - targetTop;

        document.onmousemove = function(e) {
          let top = e.pageY - shiftY;

          box.scrollTop = top * coeff;
        };

        document.onmouseup = function(e) {
          e.stopPropagation();

          document.onmousemove = document.onmouseup = null;
        }
      }
    },

    created() {
      window.onresize = () => {
        setTimeout(this.updateScrollBar, 100);
      }
    },

    beforeCreate() {
      this.$http
        .get('../server_scripts/get/homepage_data.php')
        .then(response => this.homepage = response.data)
        .catch(error => console.log(error));
    }
  }
</script>

<style lang="sass">
  $blue: #1976d2
  $lightBlue: #2196f3

  *,
  *::before,
  *::after
    box-sizing: border-box
    outline: none
    padding: 0
    margin: 0

  button::-moz-focus-inner
    border: 0

  input:invalid
    -moz-mox-shadow: none
    box-shadow: none

  a
    color: inherit

  img
    border: none

  html, body
    font: 16px "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif
    color: rgba(#000, .87)
    position: relative
    overflow: hidden
    min-width: 320px
    @media (max-width: 2540px)
      font-size: 20px
    @media (max-width: 1900px)
      font-size: 18px
    @media (max-width: 1700px)
      font-size: 17px
    @media (max-width: 1400px)
      font-size: 16px
    @media (max-width: 1200px)
      font-size: 15px
    @media (max-width: 900px)
      font-size: 14px
    @media (max-width: 500px)
      font-size: 13px

  #App
    overflow: hidden
    height: 100vh
    width: 100vw
  #page-scrollBar
    border-left: 1px solid #ccc
    background-color: #f7f7f7
    position: fixed
    height: 100vh
    display: none
    width: 8px
    z-index: 5
    right: 0
    top: 0
    #page-scroller
      background-color: $lightBlue
      transition: background .2s
      position: absolute
      cursor: pointer
      display: block
      width: 100%
      left: 0
      top: 0
      &:hover,
      &:active
        background-color: $blue

  #page-scrollBox
    width: calc(100% + 20px)
    overflow-y: scroll
    overflow-x: hidden
    position: fixed
    height: 100vh
    left: 0
    top: 0
    #page-content
      width: 100vw
      height: auto
      float: left
      &.showScroll
        padding-right: 8px

  #header
    box-shadow: inset 0 -1px 2px rgba(#000, .3)
    background: white
    min-height: 8.5vw
    width: 100%
    float: left

  #wrapper
    min-height: calc(100vh - 15.5vw)
    float: left
    width: 100%
    @media (max-width: 760px)
      min-height: 115px

  #page-body
    max-width: 1800px
    margin: 0 auto
    &::after
      display: table
      content: ''
      clear: both

  #content
    display: inline-block
    position: relative
    padding: 0 2% 1rem
    width: 75%
    margin: 0
    @media (max-width: 950px)
      width: 65%
    @media (max-width: 760px)
      min-height: 130px
      width: 100%
    h3:first-of-type
      margin: 0 0 1.3rem 0 !important
      padding: 0 !important
      font-size: 1.25rem
      font-weight: 500
      @media (max-width: 760px)
        padding: 0 !important
        text-align: center
        width: 100%
    #db-output
      max-width: 900px
      overflow-x: auto
      width: 100%
      float: left
      clear: both
      *
        border-collapse: collapse
        padding: 2px
        margin: 2px
    #date
      display: inline-block
      margin-top: 1.6rem
      text-align: right
      font-size: .8rem
      width: 100%
</style>
