Vue.component('success-notice', {
  props: ['success'],
  template: `<div v-if="success">
              <div id="success">
                <span><i class="far fa-check-circle"></i></span>
                <span>{{ success }}</span>
                <button @click="hide">繼續</button>
              </div>
            </div>`,
  methods: {
    hide() {
      notice.success = ''
    }
  }
})

Vue.component('fail-notice', {
  props: ['fail'],
  template: `<div v-if="fail">
              <div id="fail">
                <span><i class="far fa-times-circle"></i></span>
                <span>{{ fail }}</span>
                <button @click="hide">繼續</button>
              </div>
            </div>`,
  methods: {
    hide() {
      notice.fail = ''
    }
  }
})