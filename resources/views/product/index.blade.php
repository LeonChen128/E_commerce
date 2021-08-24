
@extends('layouts.common')

@section('css', './asset/css/product/index.css')
@section('title', '商品頁')

@section('content')
<div id="body" style="border: 1px solid red;">
  <template v-if="products.length">
    <div id="product-outer" v-for="product in products">
      <div id="product-frame">
        <p id="product-title"><b>@{{ product.title }}</b></p>
        <div id="product-picture"><img :src="product.img"></div>
        <div id="product-desc"><span>@{{ product.description }}</span></div>
        <p id="product-price"><span>$@{{ product.price }}</span></p>
      </div>
    </div>
  </template>

  <template v-else>
    <div id="no-products"><i>尚無資料...</i></div>
  </template>
</div>

@endsection




@section('script')
<script>
  let body = new Vue({
    el: '#body',
    data: {
      params: {
        keyWord: null,
        offset: 0
      },
      products: [],
      more: false
    },
    created() {
      let url = new URL(location.href)
      this.params.keyWord = url.searchParams.get('key')
      this.search()
    },
    methods: {
      search() {
        $.ajax({
          method: 'GET',
          data: this.params,
          dataType: 'json',
          url: '{{ config("app.url") }}' + '/api/product',
          success: (data) => {
            this.products = this.products.concat(data.products)
            this.params.offset = data.offset
            this.more = data.more
          },
          error: () => {
            this.products = []
          }
        })
      }
    }
  })
</script>
@endsection