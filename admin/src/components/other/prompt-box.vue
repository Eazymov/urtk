<template lang="html">

  <md-dialog-confirm
    :md-title="text"
    md-ok-text="Отмена"
    md-content="Отменить это действие будет невозможно"
    md-cancel-text="Удалить"
    @close="onClose"
    ref="confirm" />

</template>

<script>
export default {
  props: {
    text: {
      type: String,
      required: true
    },

    callback: {
      type: Function,
      required: false
    }
  },

  methods: {
    onClose(answer) {
      if (answer === 'cancel')
        if (typeof this.callback === 'function')
          this.callback()
    }
  }
}
</script>
