require('./bootstrap');

import Vue from 'vue';

new Vue({
  el: '#header',
  data: {
    sidebarActive: false,
    user: null,
    cartCount: 99,
    keyWord: ''
  },
  mounted() {
    document.addEventListener('click', this.closeSidebarOnClickOutside);
  },
  computed: {

  },
  methods: {
    toggleSidebar() {
      this.sidebarActive = !this.sidebarActive
    },
    closeSidebarOnClickOutside(event) {
      console.log(event.target)
      if (!this.$el.contains(event.target)) {
        this.sidebarActive = false
      }
    }
  }
})