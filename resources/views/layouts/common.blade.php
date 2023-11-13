<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:image" content="{{ asset('asset/photo/縮圖.jpg') }}" />
  <meta property="og:title" content="Leon's Website" />
  <meta property="og:description" content="這是個電商網站作品" />

  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/layouts/common.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/layouts/header.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/layouts/footer.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/vue/component/loading.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/vue/component/alert.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/icon/fontawesome/css/all.css') }}">
  <script type="text/javascript" src="{{ asset('asset/js/vue/vue.js') }}"></script>
  <script type="text/javascript" src="{{ asset('asset/js/vue/component/loading.js') }}"></script>
  <script type="text/javascript" src="{{ asset('asset/js/vue/component/alert.js') }}"></script>
  <script type="text/javascript" src="{{ asset('asset/js/jQuery/jquery.js') }}"></script>
  <script type="text/javascript" src="{{ asset('asset/js/core.js') }}"></script>
  
  <link rel="stylesheet" type="text/css" href="@yield('css')">
  <script type="text/javascript" src="@yield('js')"></script>
  <title>@yield('title')</title>
</head>
<body>

  <header id="header">
    <div id="navBar">
      <div>
        <div id="navMenu">
          <div>
            <a href="{{ url('') }}"><i class="fas fa-home"> 首頁</i></a>
          </div>

          <div>
            <a href="{{ url('user') }}"><i class="fas fa-user-circle"> 會員中心</i></a>
          </div>

          <div>
            <a href="{{ url('cart') }}"><i class="fas fa-shopping-cart"> 購物車</i></a>
            {{-- <template v-if="cartCount">
              <div class="cart-count cart-count-b">
                <span>@{{ cartCount }}</span>
              </div>
            </template> --}}
          </div>

          <div v-if="user">
            <a href="javascript:void(0)"><i class="fas fa-sign-out-alt"> 登出</i></a>
          </div>

          <div v-if="user === null" @click="showAuthTable(0)">
            <a href="javascript:void(0)"><i class="fas fa-sign-in-alt"> 登入 / 註冊</i></a>
          </div>
        </div>

        <div id="navSearch">
          <div id="hamburger">
            <div><span></span></div>
          </div>

          <form @submit.prevent="redirectTo('product?keyWord=' + keyWord)">
            <input type="text" v-model="keyWord" placeholder="找商品...">
            <button><i class="fas fa-search"></i></button>
          </form>
        </div>
      </div>
    </div>

  </header>

  {{-- <header id="header">
    <div id="header-frame">
      <div id="header-content">
        <!-- header 左 -->
        <div id="menu">
          <div class="menu-son" @click="redirectTo('product')">
            <i class="fas fa-home"></i>
            <span>首頁</span>
            <div class="menu-bar"></div>
          </div>
          <div class="menu-son" @click="toUserProfile">
            <i class="fas fa-user-circle"></i>
            <span>會員中心</span>
            <div class="menu-bar"></div>
          </div>
          <div class="menu-son" @click="redirectTo('cart')">
            <i class="fas fa-shopping-cart"></i>
            <span>購物車</span>
            <div class="menu-bar"></div>
            <template v-if="cartCount">
              <div class="cart-count cart-count-b">
                <span>@{{ cartCount }}</span>
              </div>
            </template>
          </div>
          <div v-if="user" class="menu-son" @click="showAuthTable(2)">
            <i class="fas fa-sign-out-alt"></i>
            <span>登出</span>
            <div class="menu-bar"></div>
          </div>
          <div v-if="user === null" class="menu-son" @click="showAuthTable(0)">
            <i class="fas fa-sign-in-alt"></i>
            <span>登入 / 註冊</span>
            <div class="menu-bar"></div>
          </div>
        </div>

        <div id="burger">
          <p @click="switchBurger">
            <span class="outer" :class="{'burger-none-true': burger, 'burger-none-false': !burger}"></span>
            <span class="inner" :class="{'burger-right': burger, 'burger-static': !burger}"></span>
            <span class="inner" :class="{'burger-left': burger, 'burger-static': !burger}"></span>
            <span class="outer" :class="{'burger-none-true': burger, 'burger-none-false': !burger}"></span>
          </p>
        </div>

        <div id="side-nav" :class="{'nav-show': burger, 'nav-hide': !burger}">
          <div class="nav-title" @click="redirectTo('product')">
            <i class="fas fa-home"></i>
            <span>首頁</span>
          </div>
          <div class="nav-title" @click="redirectTo('user/profile')">
            <i class="fas fa-user-circle"></i>
            <span>會員中心</span>
          </div>
          <div class="nav-title" @click="redirectTo('cart')">
            <i class="fas fa-shopping-cart"></i>
            <span>購物車</span>
            <div v-if="cartCount" class="cart-count cart-count-s">
              <span>@{{ cartCount }}</span>
            </div>
          </div>

          <div v-if="user" class="nav-title" @click="showAuthTable(2)">
            <i class="fas fa-sign-out-alt"></i>
            <span>登出</span>
          </div>
          <div v-if="user === null" class="nav-title" @click="showAuthTable(0)">
            <i class="fas fa-sign-in-alt"></i>
            <span>登入 / 註冊</span>
          </div>
        </div>

        <!-- header 右 -->
        <div id="search-frame">
          <form @submit.prevent="redirectTo('product?keyWord=' + keyWord)">
            <input type="text" v-model="keyWord" placeholder="找商品...">
            <button><i class="fas fa-search"></i></button>
          </form>
        </div>
      </div>
    </div>
  </header> --}}

  {{-- <div id="auth-frame" class="auth-frame" :class="{ 'auth-frame-bgc': table }" v-if="table">
    <template v-if="index != 2">
      <div class="auth-table">
        <div class="cross">
          <i class="fas fa-times" @click="closeAuth"></i>
        </div>

        <div class="title">@{{ index == 0 ? '使用者登入' : '使用者註冊' }}</div>

        <template v-if="index == 0">
          <form @submit.prevent="doLogin">
            <div v-if="alert" class="auth-alert">@{{ alert }}</div>
            <div v-if="notice" class="auth-notice">@{{ notice }}</div>
            <div v-if="success" class="auth-success">@{{ success }}</div>
            <div class="input-frame">
              <input type="text" v-model="loginForm.account" placeholder="請輸入帳號...">
            </div>

            <div class="input-frame">
              <input :type="passwordType" v-model="loginForm.password" placeholder="請輸入密碼..." class="password-input">
              <div class="password-eye" @click="showPassword"><i :class="eyeShow"></i></div>
            </div>
            
            <div id="button-frame">
              <button type="submit">確定</button>
            </div>
          </form>
        </template>

        <template v-else>
          <form @submit.prevent="doRegister">
            <div v-if="alert" class="auth-alert">@{{ alert }}</div>
            <div class="input-frame">
              <span class="required"><i class="fas fa-star"></i></span>
              <span v-if="accountConfirm" class="account-result result-green"><i class="fas fa-check-circle"></i></span>
              <span v-if="accountConfirm == 0" class="account-result result-red"><i class="fas fa-times-circle"></i></span>
              <input type="text" v-model="registerForm.account" placeholder="請輸入帳號..." @keyup="checkAccount">
            </div>

            <div class="input-frame">
              <span class="required"><i class="fas fa-star"></i></span>
              <input :type="passwordType" v-model="registerForm.password" placeholder="請輸入密碼..." class="password-input">
              <div class="password-eye" @click="showPassword"><i :class="eyeShow"></i></div>
            </div>

            <div class="input-frame">
              <input type="text" v-model="registerForm.name" placeholder="請輸入名字...">
            </div>

            <div class="input-frame">
              <input type="text" v-model="registerForm.address" placeholder="請輸入地址...">
            </div>

            <div class="input-frame">
              <input type="text" v-model="registerForm.phone" placeholder="請輸入電話...">
            </div>
            
            <div id="button-frame">
              <button type="submit">確定</button>
            </div>
          </form>
        </template>

        <div class="login-register-switch">
          <span @click="loginRegisterSwitch">@{{ index == 0 ? '註冊新帳號' : '已有帳號去登入' }}</span>
        </div>
      </div>
    </template>

    <template v-else>
      <div id="logout">
        <div id="logout-title">是否確定要登出？</div>
        <div id="logout-button-frame">
          <button id="cancel-btn" @click="closeAuth">取消</button>
          <button id="submit-btn" @click="doLogout">確定</button>
        </div>
      </div>
    </template>
  </div>

  <div id="container">
    @yield('content')
  </div>

  <mission-loading id="loading" v-if="show"></mission-loading>
  
  <div id="alert" v-if="msg && type">
    <message-alert :msg="msg" :type="type" @close="close"></message-alert>
  </div>
  
  <footer id="footer">
    <div id="info-frame">
      <div id="info">
        <em class="title">-- About --</em>
        <p class="info-desc">
          <b>author：Leon Chen</b>
        </p>
        <p class="info-desc">
          <b>email：<a href = "mailto: a781282000@gmail.com">a781282000@gmail.com</a></b>
        </p>
        <p class="info-desc">
          <b>based：<span>PHP / Laravel</span> | <span>Js / jQuery / Vue.js</span> | <span>Mysql</span></b>
        </p>
        <em class="title">-- contact --</em>
        <p class="link">
          <a href="https://github.com/LeonChen128" target="_blank"><i class="fab fa-github-square"></i></a>
          <b>Github</b>
        </p>
        <p class="link">
          <a href="https://www.facebook.com/jinyi.chen1/" target="_blank"><i class="fab fa-facebook-square"></i></a>
          <b>Facebook</b>
        </p>
        <p class="link">
          <a href="https://www.instagram.com/jin.yi3345678/" target="_blank"><i class="fab fa-instagram-square"></i></a>
          <b>Instagram</b>
        </p>
      </div>
    </div>
  </footer> --}}

  <script src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript">
    const appUrl = '{{ config("app.url") }}'

    let header = new Vue({
      el: '#header',
      data: {
        keyWord: '',
        url: null,
        user: false,
        burger: false,
        cartCount: null
      },
      created() {
        this.url = new URL(location.href)
        this.keyWord = this.url.searchParams.get('keyWord')

        this.calculateCartCount()
        this.getUser()
      },
      methods: {
        getUser() {
          $.ajax({
            method: 'GET',
            dataType: 'JSON',
            url: appUrl + '/api/auth/login-check',
            success: data => this.user = data.id === undefined ? null : data,
            error: data => this.user = null
          })
        },
        redirectTo(uri) {
          window.location = appUrl + '/' + uri
        },
        showAuthTable(index, notice) {
          authFrame.showTable(index, notice)
          this.burger = false
        },
        switchBurger() {
          this.burger = !this.burger
        },
        calculateCartCount() {
          this.cartCount = Array.isArray(products = Data.get('products')) && products.length
            ? products.length > 99
              ? '99'
              : products.length
            : null
        },
        toUserProfile() {
          if (!this.user) {
            this.showAuthTable(0, { type: 'notice', msg: '請先登入' })
            return
          }
          this.redirectTo('user/profile')
        }
      }
    })

    // let authFrame = new Vue({
    //   el: '#auth-frame',
    //   data: {
    //     table: false,
    //     index: 0,
    //     loginForm: {
    //       account: '',
    //       password: ''
    //     },
    //     registerForm: {
    //       account: '',
    //       password: '',
    //       name: '',
    //       address: '',
    //       phone: '',
    //     },
    //     eyeShow: 'fas fa-eye-slash',
    //     passwordType: 'password',
    //     alert: '',
    //     notice: '',
    //     success: '',
    //     timeOut: null,
    //     accountConfirm: null
    //   },
    //   methods: {
    //     messageReset() {
    //       this.alert = this.notice = this.success = ''
    //     },
    //     reset() {
    //       this.loginForm.account = this.loginForm.password = ''
    //       this.registerForm.account = this.registerForm.password = ''
    //       this.registerForm.name = this.registerForm.address = ''
    //       this.registerForm.phone = ''
    //       this.messageReset()
    //     },
    //     showTable(index, notice) {
    //       this.table = true
    //       this.index = index
    //       notice && notice.type && notice.msg && (this[notice.type] = notice.msg)
    //       typeof notice === undefined && this.reset()
    //     },
    //     doLogin() {
    //       this.messageReset()
    //       if(!this.loginForm.account || !this.loginForm.password) {
    //         this.alert = '欄位不得為空'
    //         return true
    //       }

    //       //ajax
    //       $.ajax({
    //         method: 'POST',
    //         data: {
    //           account: this.loginForm.account,
    //           password: this.loginForm.password,
    //         },
    //         dataType: 'json',
    //         url: appUrl + '/api/auth/login',
    //         success: data => window.location = header.url.href,
    //         error: ({ responseJSON }) => this.alert = responseJSON.message ?? ''
    //       })
    //     },
    //     closeAuth() {
    //       this.table = false
    //       this.reset()
    //     },
    //     showPassword() {
    //       this.eyeShow = this.eyeShow == 'fas fa-eye-slash' ? 'fas fa-eye' : 'fas fa-eye-slash'
    //       this.passwordType = this.passwordType == 'password' ? 'text' : 'password'
    //     },
    //     doLogout() {
    //       $.ajax({
    //         method: 'POST',
    //         dataType: 'json',
    //         url: appUrl + '/api/auth/logout',
    //         success: (data) => {
    //           this.user = null
    //           header.redirectTo('product')
    //         },
    //         error: data => this.user = null
    //       })
    //     },
    //     loginRegisterSwitch() {
    //       this.index = this.index == 0 ? 1 : 0
    //       this.reset()
    //     },
    //     checkAccount() {
    //       if (this.timeOut) { clearTimeout(this.timeOut) }

    //       this.timeOut = setTimeout(_ => {
    //         if (!this.registerForm.account.trim()) { return true }

    //         $.ajax({
    //           method: 'POST',
    //           dataType: 'json',
    //           url: appUrl + '/api/auth/register-check',
    //           data: { account: this.registerForm.account.trim() },
    //           success: data => this.accountConfirm = data,
    //           error: _ => this.accountConfirm = false
    //         })
    //       }, 500)
    //     },
    //     doRegister() {
    //       this.messageReset()
    //       this.registerForm.account = this.registerForm.account.trim()
    //       this.registerForm.password = this.registerForm.password.trim()

    //       if (this.accountConfirm == 0) {
    //         this.alert = '帳號已存在'
    //         return true
    //       }
    //       if (!this.registerForm.account || !this.registerForm.password) {
    //         this.alert = '帳號密碼不得為空'
    //         return true
    //       }

    //       $.ajax({
    //         method: 'POST',
    //         dataType: 'json',
    //         url: appUrl + '/api/auth/create',
    //         data: {
    //           account: this.registerForm.account,
    //           password: this.registerForm.password,
    //           name: this.registerForm.name,
    //           address: this.registerForm.address,
    //           phone: this.registerForm.phone,
    //         },
    //         beforeSend: _ => loading.show = true,
    //         complete: _ => loading.show = false,
    //         success: data => {
    //           this.reset()
    //           this.accountConfirm = null
    //           this.index = 0
    //           this.success = '註冊成功'
    //         },
    //         error: _ => this.alert = '發生錯誤'
    //       })
    //     }
    //   }
    // })

    // let loading = new Vue({ el: '#loading', data: { show: false } })

    // let alert = new Vue({
    //   el: '#alert',
    //   data: {
    //     msg: '',
    //     type: ''
    //   },
    //   methods: {
    //     success(msg) {
    //       this.msg = msg
    //       this.type = 'success'
    //     },
    //     fail(msg) {
    //       this.msg = msg
    //       this.type = 'fail'
    //     },
    //     close() {
    //       this.msg = this.type = ''
    //     }
    //   }
    // })

  </script>
  @yield('script')
</body>
</html>
