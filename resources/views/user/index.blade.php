
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
      <div id="user-info-title">
        <span>我的檔案</span>
      </div>

      <div id="user-info-content" style="border: 1px solid green">
        <div style="border: 2px solid black">
          <div style="border: 1px solid red">
            <span>帳號</span>
          </div>
          <div style="border: 1px solid red">
            <span>姓名</span>
          </div>
        </div>

        <div style="border: 2px solid black">
          <img v-if="previewImg" id="head-photo" :src="previewImg">
          <img v-else id="head-photo" src="{{ $user['head'] }}">
          <form @submit.prevent enctype="multipart/form-data">
            <input type="file" id="head-input" accept="image/*" multiple="multiple" @change="preview">
            <label id="head-input-btn" for="head-input">選擇圖片</label>
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
  let user = new Vue({
    el: '#user',
    data: {
      formData: null,
      file: null,
      previewImg: null
    },
    created() {

    },
    methods: {
      updateHead() {
        if (this.formData == null) return true

        let formData = this.formData

        $.ajax({
          method: 'POST',
          dataType: 'JSON',
          url: '{{ config("app.url") }}' + '/api/user/{{ $user["id"] }}',
          processData: false,
          contentType: false,
          data: formData,
          success(data) {
            notice.success = '上傳成功'
          },
          error() {
            notice.fail = '上傳失敗'
          }
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