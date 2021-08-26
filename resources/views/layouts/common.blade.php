<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="/asset/css/layouts/common.css">
  <link rel="stylesheet" type="text/css" href="/asset/css/layouts/header.css">
  <link rel="stylesheet" type="text/css" href="/asset/icon/fontawesome/css/all.css">
  <script type="text/javascript" src="/asset/js/vue.js"></script>
  <script type="text/javascript" src="/asset/js/jQuery/jquery.js"></script>
  
  <link rel="stylesheet" type="text/css" href="@yield('css')">
  <script type="text/javascript" src="@yield('js')"></script>
  <title>@yield('title')</title>
</head>
<body>

  <div id="header">
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
          <div class="menu-sun" @click="showLogin()">
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
  </div>

  <div v-if="show" id="login-frame" :style="'height: ' + height + 'px'">
    <div id="login">
      <div id="cross">
        <i class="fas fa-times" @click="showLogin"></i>
      </div>
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
          <button type="sumit" @click="doLogin">確定</button>
        </div>
      </form>

      <div id="register-ancor">
        <a href="">註冊新帳號</a>
      </div>
    </div>
  </div>

  @yield('content')

  <script type="text/javascript">
    let header = new Vue({
      el: '#header',
      data: {
        keyWord: '',
        url: null,
      },
      created() {
        this.url = new URL(location.href)
        this.keyWord = this.url.searchParams.get('key')
      },
      methods: {
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
          loginFrame.height = document.body.clientHeight
          loginFrame.show = !loginFrame.show
        }
      }
    })

    let loginFrame = new Vue({
      el: '#login-frame',
      data: {
        show: false,
        account: '',
        password: '',
        eyeShow: 'fas fa-eye-slash',
        passwordType: 'password',
        message: '',
        height: 0
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

          setTimeout(function() {
            this.message = '帳密錯誤'
            console.log(this.message)
          }, 1000)
          // ajax
        },
        showLogin() {
          this.height = document.body.clientHeight
          
          this.show = !this.show
          if (this.show == false) { this.reset() }
        },
        showPassword() {
          this.eyeShow = this.eyeShow == 'fas fa-eye-slash' ? 'fas fa-eye' : 'fas fa-eye-slash'
          this.passwordType = this.passwordType == 'password' ? 'text' : 'password'
        }
      }

    })
  </script>
  @yield('script')
</body>
</html>