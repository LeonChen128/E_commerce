<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="/asset/css/layouts/common.css">
  <link rel="stylesheet" type="text/css" href="/asset/css/layouts/header.css">
  <link rel="stylesheet" type="text/css" href="/asset/css/layouts/footer.css">
  <link rel="stylesheet" type="text/css" href="/asset/css/vue/component/loading.css">
  <link rel="stylesheet" type="text/css" href="/asset/css/vue/component/notice.css">
  <link rel="stylesheet" type="text/css" href="/asset/icon/fontawesome/css/all.css">
  <script type="text/javascript" src="/asset/js/vue/vue.js"></script>
  <script type="text/javascript" src="/asset/js/vue/component/loading.js"></script>
  <script type="text/javascript" src="/asset/js/vue/component/notice.js"></script>
  <script type="text/javascript" src="/asset/js/jQuery/jquery.js"></script>
  
  <link rel="stylesheet" type="text/css" href="@yield('css')">
  <script type="text/javascript" src="@yield('js')"></script>
  <title>@yield('title')</title>
</head>
<body>

  <header id="header">
    <div id="header-frame">
      <div id="header-content">
        <!-- header 左 -->
        <div id="menu">
          <div class="menu-son" @click="redirect('product')">
            <i class="fas fa-home"></i>
            <span>賣得好</span>
            <div class="menu-bar"></div>
          </div>
          <div class="menu-son" @click="redirect('user')">
            <i class="fas fa-user-circle"></i>
            <span>會員中心</span>
            <div class="menu-bar"></div>
          </div>
          <div class="menu-son" @click="redirect('cart')">
            <i class="fas fa-shopping-cart"></i>
            <span>購物車</span>
            <div class="menu-bar"></div>
            <div v-if="cartCount" class="cart-count cart-count-b">
              <span>@{{ cartCount }}</span>
            </div>
          </div>
          <div class="menu-son" @click="redirect('pay')">
            <i class="fas fa-shopping-bag"></i>
            <span>買單去</span>
            <div class="menu-bar"></div>
          </div>
          <div v-if="user" class="menu-son" @click="showLogout">
            <i class="fas fa-sign-out-alt"></i>
            <span>登出</span>
            <div class="menu-bar"></div>
          </div>
          <div v-else class="menu-son" @click="showLogin">
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
          <div class="nav-title" @click="redirect('product')">
            <i class="fas fa-home"></i>
            <span>賣得好</span>
          </div>
          <div class="nav-title" @click="redirect('user')">
            <i class="fas fa-user-circle"></i>
            <span>會員中心</span>
          </div>
          <div class="nav-title" @click="redirect('cart')">
            <i class="fas fa-shopping-cart"></i>
            <span>購物車</span>
            <div v-if="cartCount" class="cart-count cart-count-s">
              <span>@{{ cartCount }}</span>
            </div>
          </div>
          <div class="nav-title" @click="redirect('pay')">
            <i class="fas fa-shopping-bag"></i>
            <span>買單去</span>
          </div>

          <div v-if="user" class="nav-title" @click="showLogout">
            <i class="fas fa-sign-out-alt"></i>
            <span>登出</span>
          </div>
          <div v-else class="nav-title" @click="showLogin">
            <i class="fas fa-sign-in-alt"></i>
            <span>登入 / 註冊</span>
          </div>
        </div>



        <!-- header 右 -->
        <div id="search-frame">
          <form @submit.prevent="search">
            <input type="text" v-model="keyWord" placeholder="找商品...">
            <button><i class="fas fa-search"></i></button>
          </form>
        </div>
      </div>
    </div>
  </header>

  <div id="auth-frame">
    <template v-if="loginTable || logoutTable || registerTable">
      <div class="auth-frame">
        <template v-if="loginTable">
          <div id="login">
            <div class="cross">
              <i class="fas fa-times" @click="closeLogin"></i>
            </div>

            <div class="login-title">使用者登入</div>

            <form @submit.prevent="doLogin">
              <div v-if="message" class="auth-message">@{{ message }}</div>
              <div v-if="success" class="auth-success">@{{ success }}</div>
              <div class="input-frame">
                <input type="text" v-model="account" placeholder="請輸入帳號...">
              </div>

              <div class="input-frame">
                <input :type="passwordType" v-model="password" placeholder="請輸入密碼..." class="password-input">
                <div class="password-eye" @click="showPassword"><i :class="eyeShow"></i></div>
              </div>
              
              <div id="button-frame">
                <button type="submit">確定</button>
              </div>
            </form>

            <div class="switch-table">
              <span @click="showRegister">註冊新帳號</span>
            </div>
          </div>
        </template>

        <template v-if="registerTable">
          <div id="register">
            <div class="cross">
              <i class="fas fa-times" @click="closeRegister"></i>
            </div>

            <div class="login-title">註冊新帳號</div>

            <form @submit.prevent="doRegister">
              <div v-if="message" class="auth-message">@{{ message }}</div>
              <div class="input-frame">
                <span class="required"><i class="fas fa-star"></i></span>
                <span v-if="accountConfirm" class="account-result result-green"><i class="fas fa-check-circle"></i></span>
                <span v-if="accountConfirm == 0" class="account-result result-red"><i class="fas fa-times-circle"></i></span>
                <input type="text" v-model="account" placeholder="請輸入帳號..." @keyup="checkAccount">
              </div>

              <div class="input-frame">
                <span class="required"><i class="fas fa-star"></i></span>
                <input :type="passwordType" v-model="password" placeholder="請輸入密碼..." class="password-input">
                <div class="password-eye" @click="showPassword"><i :class="eyeShow"></i></div>
              </div>

              <div class="input-frame">
                <input type="text" v-model="name" placeholder="請輸入名字...">
              </div>

              <div class="input-frame">
                <input type="text" v-model="address" placeholder="請輸入地址...">
              </div>

              <div class="input-frame">
                <input type="text" v-model="phone" placeholder="請輸入電話...">
              </div>
              
              <div id="button-frame">
                <button type="submit">確定</button>
              </div>
            </form>

            <div class="switch-table">
              <span @click="showLogin">已有帳號去登入</span>
            </div>
          </div>
        </template>

        <template v-if="logoutTable">
          <div id="logout">
            <div id="logout-title">是否確定要登出？</div>
            <div id="logout-button-frame">
              <button id="cancel-btn" @click="cancelLogout">取消</button>
              <button id="submit-btn" @click="doLogout">確定</button>
            </div>
          </div>
        </template>
      </div>
    </template>
  </div>

  <div id="body">
    @yield('content')
  </div>

  <mission-loading id="loading" v-if="show"></mission-loading>
  
  <div id="notice" v-if="success || fail">
    <success-notice :success="success"></success-notice>
    <fail-notice :fail="fail"></fail-notice>
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
  </footer>

  <script type="text/javascript">
    let header = new Vue({
      el: '#header',
      data: {
        keyWord: '',
        url: null,
        user: null,
        burger: false,
        cartCount: null
      },
      created() {
        this.url = new URL(location.href)
        this.keyWord = this.url.searchParams.get('key')

        this.cartCount = Array.isArray(tmp = JSON.parse(localStorage.getItem('items'))) && tmp.length
          ? tmp.length > 9 ? '9+' : tmp.length
          : null

        this.userCheck()
      },
      methods: {
        userCheck() {
          $.ajax({
            method: 'GET',
            dataType: 'json',
            url: '{{ config("app.url") }}' + '/api/auth/check',
            success: (data) => {
              this.user = data.id == undefined ? null : data
            },
            error: (data) => {
              this.user = null
            }
          })
        },
        redirect(uri) {
          window.location = '{{ config("app.url") }}/' + uri
        },
        search() {
          if (this.url.href != ('{{ config("app.url") }}/' + 'product')) {
            window.location = '{{ config("app.url") }}/' + uri + (this.keyWord ? ('?=' + this.keyWord) : '')
          }
          body.params.keyWord = this.keyWord
          body.params.offset = 0
          body.products = []
          body.search()
        },
        showLogin() {
          authFrame.loginTable = !authFrame.loginTable
          authFrame.registerTable = false
          authFrame.reset()
          this.burger = false
        },
        showLogout() {
          this.burger = false
          authFrame.logoutTable = !authFrame.logoutTable
        },
        switchBurger() {
          this.burger = !this.burger
          console.log(this.burger)
        }
      }
    })

    let authFrame = new Vue({
      el: '#auth-frame',
      data: {
        loginTable: false,
        logoutTable: false,
        account: '',
        password: '',
        eyeShow: 'fas fa-eye-slash',
        passwordType: 'password',
        message: '',
        success: '',

        registerTable: false,
        name: '',
        address: '',
        phone: '',
        timeOut: null,
        accountConfirm: null
      },
      methods: {
        reset() {
          this.account = ''
          this.password = ''
          this.eyeShow = 'fas fa-eye-slash'
          this.passwordType = 'password'
          this.message = ''
          this.name = ''
          this.address = ''
          this.phone = ''
          this.accountConfirm = null
          this.success = ''
        },
        doLogin() {
          this.message = ''
          this.success = ''
          if(!this.account || !this.password) {
            this.message = '欄位不得為空'
            return true
          }

          //ajax
          $.ajax({
            method: 'POST',
            data: {
              account: this.account,
              password: this.password,
            },
            dataType: 'json',
            url: '{{ config("app.url") }}' + '/api/auth/login',
            beforeSend: _ => {
              
            },
            complete: _ => {
              
            },
            success: (data) => {
              window.location = '{{ config("app.url") }}/product'
            },
            error: (data) => {
              if (message = data.responseJSON.message) {
                this.message = message
              }
            }
          })
        },
        closeLogin() {
          this.loginTable = false
          this.reset()
        },
        showPassword() {
          this.eyeShow = this.eyeShow == 'fas fa-eye-slash' ? 'fas fa-eye' : 'fas fa-eye-slash'
          this.passwordType = this.passwordType == 'password' ? 'text' : 'password'
        },
        cancelLogout() {
          this.logoutTable = false
        },
        doLogout() {
          $.ajax({
            method: 'POST',
            dataType: 'json',
            url: '{{ config("app.url") }}' + '/api/auth/logout',
            success: (data) => {
              this.user = null
              window.location = '{{ config("app.url") }}/product'
            },
            error: (data) => {
              this.user = null
            }
          })
        },
        showRegister() {
          this.loginTable = false
          this.reset()
          this.registerTable = true
        },
        closeRegister() {
          this.registerTable = false
          this.reset()
        },
        checkAccount() {
          if (this.timeOut) { clearTimeout(this.timeOut) }

          this.timeOut = setTimeout(_ => {
            if (!this.account.trim()) { return true }

            $.ajax({
              method: 'POST',
              dataType: 'json',
              url: '{{ config("app.url") }}' + '/api/auth/register-check',
              data: { account: this.account.trim() },
              success: (data) => {
                this.accountConfirm = data
              },
              error: _ => {
                this.accountConfirm = false
              }
            })
          }, 500)
        },
        doRegister() {
          this.message = ''
          this.account = this.account.trim()
          this.password = this.password.trim()

          if (this.accountConfirm == 0) {
            this.message = '帳號已存在'
            return true
          }
          if (!this.account || !this.password) {
            this.message = '帳號密碼不得為空'
            return true
          }

          $.ajax({
            method: 'POST',
            dataType: 'json',
            url: '{{ config("app.url") }}' + '/api/auth/create',
            data: {
              account: this.account,
              password: this.password,
              name: this.name,
              address: this.address,
              phone: this.phone,
            },
            beforeSend: _ => {
              loading.show = true
            },
            complete: _ => {
              loading.show = false
            },
            success: (data) => {
              this.reset()
              this.loginTable = true
              this.registerTable = false
              this.success = '註冊成功'
            },
            error: _ => {
              this.message = '發生錯誤'
            }
          })
        },
        showLogin() {
          this.registerTable = false
          this.reset()
          this.loginTable = true
        }
      }
    })

    let loading = new Vue({ el: '#loading', data: { show: false } })

    let notice = new Vue({
      el: '#notice',
      data: {
        success: '',
        fail: ''
      }
    })

  </script>
  @yield('script')
</body>
</html>