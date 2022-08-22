
@extends('layouts.common')

@section('css', '/asset/css/user/profile.css')
@section('title', '個人頁面')

@section('content')
<div id="profile">
  <div id="user-menu">
    <div>
      <p class="user-menu-title">
        <i class="far fa-user"></i>
        <span>我的帳戶</span>
      </p>

      <p class="user-menu-content">
        <a href="/user/profile" style="color: tomato; text-decoration: none">個人檔案</a>
        <a href="/user/password" style="text-decoration: none">更改密碼</a>
        <a href="/user/order" style="text-decoration: none">訂單查詢</a>
        <a href="/user/record" style="text-decoration: none">購買紀錄</a>
      </p>
    </div>

  </div>

  <div id="user-info">
    <div>
      <div id="user-info-title">
        <span>我的檔案</span>
      </div>

      <div id="user-info-content">
        <div>
          <form @submit.prevent>
            <div class="user-left-div">
              <span>帳號</span>
              <span>{{ $user['account'] }}</span>
            </div>
            <div class="user-left-div">
              <span>姓名</span>
              <input type="text" V-model="name">
            </div>
            <div class="user-left-div">
              <span>地址</span>
              <input type="text" V-model="address">
            </div>
            <div class="user-left-div">
              <span>電話</span>
              <input type="text" V-model="phone">
            </div>
            <button id="profile-save-btn" @click="update">儲存</button>
          </form>
        </div>

        <div id="head-photo-frame">
          <img v-if="previewImg" id="head-photo" :src="previewImg">
          <img v-else id="head-photo" src="{{ $user['head'] }}">
          <form @submit.prevent enctype="multipart/form-data">
            <input type="file" id="head-input" accept="image/*" multiple="multiple" @change="preview">
            <label id="head-input-btn" for="head-input">選擇頭像</label>
            <button v-if="previewImg" id="update-head" @click="updateHead">確定上傳</button>
          </form>
        </div>
        
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  let profile = new Vue({
    el: '#profile',
    data: {
      formData: null,
      file: null,
      previewImg: null,
      name: '{{$user["name"]}}',
      address: '{{$user["address"]}}',
      phone: '{{$user["phone"]}}',
    },
    created() {

    },
    methods: {
      update() {
        $.ajax({
          method: 'PUT',
          dataType: 'JSON',
          url: appUrl + '/api/user/{{ $user["id"] }}',
          data: {
            name: this.name,
            address: this.address,
            phone: this.phone,
          },
          success: data => alert.success(data.message),
          error: data => alert.fail(data.responseJSON.message)
        })
      },
      updateHead() {
        if (this.formData == null) return true
        let formData = this.formData

        $.ajax({
          method: 'POST',
          dataType: 'JSON',
          url: appUrl + '/api/user/{{ $user["id"] }}',
          processData: false,
          contentType: false,
          data: formData,
          success: data => alert.success(data.message),
          error: data => alert.fail(data.responseJSON.message)
        })
      },
      preview(e) {
        if (e.target.files[0] === undefined) return true
        
        let render = new FileReader()
        render.readAsDataURL(this.file = e.target.files[0])
        render.onload = e => {
          this.previewImg = e.target.result
        }

        this.formData = new FormData()
        this.formData.append('img', this.file)
      }
    }
  })
</script>

@endsection
