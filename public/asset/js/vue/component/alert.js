
Vue.component('message-alert', {
  props: {
    msg: { type: String },
    type: { type: String }
  },
  methods: {
    hide() {
      this.$emit('close')
    }
  },
  template: `
    <div id="message-alert" :class="type">
      <span><i class="far" :class="type == 'success' ? 'fa-check-circle' : 'fa-times-circle'"></i></span>
      <span>{{ msg }}</span>
      <button @click="hide">繼續</button>
    </div>
  `
})
