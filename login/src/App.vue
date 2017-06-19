<template lang="html">
  <div id="App">

    <form class="auth-form" @submit.prevent="authorizate(login, pass)">
      <h2 class="auth-form__title">Авторизация</h2>

      <fieldset>
        <input @input="denied = false"
               :class="{ 'filled': login, 'denied': denied }"
               class="auth-form__login"
               type='text'
               v-model="login"
               autocomplete="off"
               required />
        <label>Логин</label>
        <span class="highlighter"></span>
      </fieldset>

      <fieldset>
        <input @input="denied = false"
               :class="{ 'filled': pass, 'denied': denied }"
               class="auth-form__password"
               type="password"
               v-model="pass"
               required />
        <label>Пароль</label>
        <span class="highlighter"></span>
      </fieldset>

      <material-button class="auth-form__submit"
                       :type="'submit'"
                       :text="'Войти'"
                       :disabled="loading" />

      <loader class="auth-form__loader" v-show="loading" />

      <p class="auth-form__denied" v-show="denied">Неверный логин или пароль</p>
    </form>

  </div>
</template>

<script>
  export default {
    data: () => ({
      login: '',
      pass: '',
      loginIsFilled: false,
      passIsFilled: false,
      loading: false,
      denied: false
    }),

    methods: {
      authorizate(login, pass) {
        this.loading = true;
        this.denied  = false;

        this.$http
          .post('index.php', { login, pass })
          .then(this.handleAjaxLoad)
          .catch(error => console.log(error));
      },

      handleAjaxLoad(response) {
        if (response.data === 'denied') {
          this.loading = false;
          this.denied  = true;
        } else {
          location = '../../admin/';
        }
      }
    }
  }
</script>

<style lang="sass">
  *,
  *::before,
  *::after
    box-sizing: border-box
    outline: none
    padding: 0
    margin: 0

  input
    background-color: #fff

  button::-moz-focus-inner
    border: 0

  html, body
    font: 16px "Roboto", "Helvetica Neue", Helvetica, Arial, sans-serif
    color: rgba(#000, .87)
    background: #eee
    height: 100%
    width: 100%

  #App
    justify-content: center
    flex-direction: column
    align-items: center
    height: 100%
    width: 100%
    display: flex

    .auth-form
      box-shadow: 0px 1px 2px rgba(#000, .3)
      border: 1px solid #ddd
      padding: 10px 35px
      margin-top: -10vh
      background: #fff
      position: relative
      height: 277px
      width: 340px
      &__title
        text-align: center
        font-weight: 400
      fieldset
        margin-top: 40px
        position: relative
        border: none
        width: 100%
        label
          color: rgba(#000, .54)
          pointer-events: none
          position: absolute
          font-size: 1.2rem
          transition: .2s
          z-index: 0
          top: 4px
          left: 5px
        .highlighter
          background: #4a89dc
          margin: -1px auto
          position: relative
          display: block
          transition: .2s
          height: 2px
          z-index: 2
          width: 0
        input
          border: none
          border-bottom: 1px solid #555
          background: transparent
          font-family: inherit
          font-size: 1.2rem
          position: relative
          transition: .2s
          padding: 5px
          width: 100%
          z-index: 1
          &:invalid
            -moz-mox-shadow: none
            box-shadow: none
          &:focus
            & + label
              font-size: 1rem
              color: #4a89dc
              top: -21px
              left: 4px
              & + .highlighter
                width: 100%

          &.filled + label
            font-size: 1rem
            color: #4a89dc
            top: -21px
            left: 4px

          &.denied
            & + label
              color: red
              & + .highlighter
                background: red
                width: 100%

      &__submit
          margin: 30px 0 10px

      &__loader
        margin: 0 calc(50% - 25px)
        position: absolute
        bottom: -65px
        height: 50px
        width: 50px
        left: 0

      &__denied
        position: absolute
        font-size: 1.1rem
        text-align: center
        bottom: -35px
        width: 100%
        color: red
        left: 0
</style>
