<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="./asset/css/common.css">
  <link rel="stylesheet" type="text/css" href="./asset/css/header.css">
  <link rel="stylesheet" type="text/css" href="./asset/icon/fontawesome/css/all.css">
  <script type="text/javascript" src="./asset/js/vue.js"></script>
  <script type="text/javascript" src="./asset/js/jQuery/jquery.js"></script>

  <title>賣得好</title>
</head>
<body>

  <div id="header">
    <div id="content">
      <!-- header 左 -->
      <div id="menu">
        <div class="menu-sun">
          <i class="fas fa-home"></i>
          <span>賣得好</span>
          <div class="menu-bar"></div>
        </div>
        <div class="menu-sun">
          <i class="fas fa-user-circle"></i>
          <span>會員中心</span>
          <div class="menu-bar"></div>
        </div>
        <div class="menu-sun">
          <i class="fas fa-shopping-cart"></i>
          <span>購物車</span>
          <div class="menu-bar"></div>
        </div>
        <div class="menu-sun">
          <i class="fas fa-shopping-bag"></i>
          <span>買單去</span>
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



  <script type="text/javascript">
    let app = new Vue({
        el: '#header',
        data: {
          keyWord: null
        },
        methods: {
          search() {
            console.log(123)
          }
        }

    })
      
  </script>
</body>
</html>