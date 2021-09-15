
@extends('layouts.common')

@section('css', '/asset/css/user/index.css')
@section('title', '個人頁面')

@section('content')
<div id="user">
  <div id="user-menu" style="border: 1px solid red">
    <div style="border: 1px solid green">

      <p class="user-menu-title" style="border: 1px solid block">
        <i class="far fa-user"></i>
        <span>我的帳戶</span>
      </p>

      <p class="user-menu-content" style="border: 1px solid gray">
        <span style="color: tomato">個人檔案</span>
        <span>地址</span>
        <span>更改密碼</span>
      </p>

    </div>

  </div>

  <div id="user-info">
    <div>
      
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  let user = new Vue({
    el: '#user'
  })
</script>

@endsection