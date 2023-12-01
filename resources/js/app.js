require('./bootstrap');

import { getParameterByName } from './core';

const header_params = {
  data: {
    cartCount: 0,
    sidebarActive: false,
    user: null
  },
  methods: {
    init: () => {

    },
    logout: () => {
      console.log('doLogout')
    }
  }
}

const header = defineComponent({
  props: {
    carts: { type: Number, default: 0 },
    sidebar: { type: Boolean, default: false },
    user: { type: Object, default: null }
  },
  data() {
    return {
      keyword: getParameterByName('keyword')
    }
  },
  methods: {
    searchProduct() {
      window.location.href = this.keyword.trim() === ''
        ? '/product'
        : '/product?keyword=' + this.keyword
    }
  },
  template: `
    <header id="header">
      <div id="navbar">
        <div>
          <div id="navMenu">
            <div>
              <a href="/"><i class="fas fa-home"> 首頁</i></a>
            </div>

            <div>
              <a href="/user"><i class="fas fa-user-circle"> 會員中心</i></a>
            </div>

            <div>
              <a href="/cart"><i class="fas fa-shopping-cart" :class="{ 'count-alert': carts > 0 }" :count="carts"> 購物車</i></a>
            </div>

            <div v-cloak v-show="user" @click="$emit('logout')">
              <a href="javascript:void(0)"><i class="fas fa-sign-out-alt"> 登出</i></a>
            </div>

            <div v-cloak v-show="user === null">
              <a href="/login"><i class="fas fa-sign-in-alt"> 登入 / 註冊</i></a>
            </div>
          </div>

          <div id="navSearch">
            <div id="hamburger" @click="$emit('toggle')" ref="hamburger">
              <div><span></span></div>
            </div>

            <form @submit.prevent="searchProduct">
              <input type="text" v-model="keyword" placeholder="找商品...">
              <button><i class="fas fa-search"></i></button>
            </form>
          </div>
        </div>
      </div>

      <div id="sidebar" :class="{ 'active': sidebar }" ref="sidebar">
        <div class="cross" @click="$emit('toggle')">
          <i class="fas fa-times"></i>
        </div>
        
        <div>
          <a href="/"><i class="fas fa-home"> 首頁</i></a>
        </div>

        <div>
          <a href="/user"><i class="fas fa-user-circle"> 會員中心</i></a>
        </div>

        <div>
          <a href="/cart"><i class="fas fa-shopping-cart" :class="{ 'count-alert': carts > 0 }" :count="carts"> 購物車</i></a>
        </div>

        <div v-show="user" @click="$emit('logout')">
          <a href="javascript:void(0)"><i class="fas fa-sign-out-alt"> 登出</i></a>
        </div>

        <div v-show="user === null">
          <a href="/login"><i class="fas fa-sign-in-alt"> 登入 / 註冊</i></a>
        </div>
      </div>
    </header>
  `
})

export { header, header_params };
