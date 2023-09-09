
@extends('layouts.common')

@section('css', url('asset/css/user/password.css'))
@section('title', '修改個人密碼')

@section('content')
<div id="password">
  
</div>
@endsection

@section('script')
<script>
  let password = new Vue({
    el: '#password',
    data: {
      password: '',
      rePassword: ''
    },
    methods: {
      submit() {
        if (this.password === '' || this.rePassword === '') {
          alert.fail('密碼＆重複密碼欄位不得為空，請重新輸入')
          return
        }

        if (this.password !== this.rePassword) {
          alert.fail('密碼＆重複密碼不一致，請重新輸入')
          return
        }

        let params = { password: this.password }

        // $.ajax({
        //   method: 'PUT',
        //   dataType: 'JSON',
        //   url: appUrl + '/api/user/{{ $user["id"] ?? '' }}',
        //   data: params,
        //   success: data => ,
        //   error: data => ,
        // })
      }
    }
  })
</script>
@endsection
