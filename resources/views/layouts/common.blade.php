<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="/asset/css/layouts/common.css">
  <link rel="stylesheet" type="text/css" href="/asset/css/layouts/header.css">
  <link rel="stylesheet" type="text/css" href="/asset/css/layouts/footer.css">
  <link rel="stylesheet" type="text/css" href="/asset/icon/fontawesome/css/all.css">
  <script type="text/javascript" src="/asset/js/vue.js"></script>
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
          <div class="menu-sun" @click="redirect('product')">
            <i class="fas fa-home"></i>
            <span>賣得好</span>
            <div class="menu-bar"></div>
          </div>
          <div class="menu-sun" @click="redirect('user')">
            <i class="fas fa-user-circle"></i>
            <span>會員中心</span>
            <div class="menu-bar"></div>
          </div>
          <div class="menu-sun" @click="redirect('cart')">
            <i class="fas fa-shopping-cart"></i>
            <span>購物車</span>
            <div class="menu-bar"></div>
          </div>
          <div class="menu-sun" @click="redirect('pay')">
            <i class="fas fa-shopping-bag"></i>
            <span>買單去</span>
            <div class="menu-bar"></div>
          </div>
          <div v-if="user" class="menu-sun" @click="showLogout">
            <i class="fas fa-sign-out-alt"></i>
            <span>登出</span>
            <div class="menu-bar"></div>
          </div>
          <div v-else class="menu-sun" @click="showLogin()">
            <i class="fas fa-sign-in-alt"></i>
            <span>登入 / 註冊</span>
            <div class="menu-bar"></div>
          </div>
        </div>

        <div id="buger">
          <p>
            <i class="fas fa-bars"></i>
          </p>
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

  <div v-if="loginTable || logoutTable" id="login-frame">
    <div v-if="loginTable" id="login">
      <div id="cross">
        <i class="fas fa-times" @click="closeLogin"></i>
      </div>

      <div id="login-title">使用者登入</div>

      <form @submit.prevent="doLogin">
        <div v-if="message" id="login-message">@{{ message }}</div>
        <div class="input-frame">
          <input type="text" v-model="account" placeholder="請輸入帳號...">
        </div>

        <div class="input-frame">
          <input :type="passwordType" v-model="password" placeholder="請輸入密碼..." class="password-input">
          <div class="password-eye" @click="showPassword"><i :class="eyeShow"></i></div>
        </div>
        
        <div id="button-frame">
          <button type="sumit">確定</button>
        </div>
      </form>

      <div id="register-ancor">
        <a href="">註冊新帳號</a>
      </div>
    </div>

    <div v-if="logoutTable" id="logout">
      <div id="logout-title">是否確定要登出？</div>
      <div id="logout-button-frame">
        <button id="cancel-btn" @click="cancelLogout">取消</button>
        <button id="submit-btn" @click="doLogout">確定</button>
      </div>
    </div>
  </div>

  @yield('content')

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
      },
      created() {
        this.url = new URL(location.href)
        this.keyWord = this.url.searchParams.get('key')
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
          loginFrame.loginTable = !loginFrame.loginTable
          loginFrame.reset()
        },
        showLogout() {
          loginFrame.logoutTable = !loginFrame.logoutTable
        }
      }
    })

    let loginFrame = new Vue({
      el: '#login-frame',
      data: {
        loginTable: false,
        logoutTable: false,
        account: '',
        password: '',
        eyeShow: 'fas fa-eye-slash',
        passwordType: 'password',
        message: '',
      },
      methods: {
        reset() {
          this.account = ''
          this.password = ''
          this.eyeShow = 'fas fa-eye-slash'
          this.passwordType = 'password'
          this.message = ''
        },
        doLogin() {
          this.message = ''
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
        }
      }

    })
  </script>
  @yield('script')
</body>
</html>