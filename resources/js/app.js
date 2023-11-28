require('./bootstrap');

import { createApp, ref } from 'vue';
import Vuex from 'vuex';

const app = createApp({
  data() {
    return {
      sidebarActive: false,
      user: null,
      cartCount: 99,
      keyWord: ''
    };
  },
  mounted() {
    this.$nextTick(() => {
      // 點擊 sidebar 以外區域關閉 sidebar
      window.addEventListener('click', this.closeSidebarOnClickOutside);
    });
  },
  methods: {
    logout() {
      console.log('do logout');
    },
    searchProduct() {
      console.log('do search:' + this.keyWord);
    },
    toggleSidebar() {
      this.sidebarActive = !this.sidebarActive;
    },
    closeSidebarOnClickOutside(event) {
      const domHamburger = this.$refs.hamburger;
      const domSidebar = this.$refs.sidebar;

      if (domHamburger.contains(event.target)) {
        return true;
      }

      if (!domSidebar.contains(event.target)) {
        this.sidebarActive = false;
      }
    }
  }
}).mount('#header')
