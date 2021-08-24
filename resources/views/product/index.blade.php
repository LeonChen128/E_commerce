
@extends('layouts.common')

@section('css', './asset/css/product/index.css')
@section('title', '商品頁')

@section('content')
  <div id="body" style="border: 1px solid red;">
    <template v-if="products.length">
      <div id="product-outer" v-for="product in products" style="border: 1px solid green;">
        <div id="product-frame">
          <p id="product-title"><b>@{{ product.title }}</b></p>
          <div id="product-picture"><img :src="product.img"></div>
          <div id="product-desc" style="border: 1px solid yellow;"><span>@{{ product.description }}</span></div>
          <p id="product-price"><span>$@{{ product.price }}</span></p>
        </div>
      </div>
    </template>
  </div>
@endsection




@section('script')
<script>
let body = new Vue({
  el: '#body',
  data: {
    page: null,
    products: [],
  },
  created() {

    let url = new URL(location.href)
    this.page = url.searchParams.get('page')

    $.ajax({
      method: 'GET',
      // data: {
      //   page: 
      // },
      dataType: 'json',
      url: 'http://127.0.0.1:8000/api/product',
      success: (data) => {
        this.products = data
      },
      error: () => {

      }

    })
  },
  methods: {
  }
})
</script>
@endsection