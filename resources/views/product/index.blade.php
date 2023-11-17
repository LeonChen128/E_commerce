
@extends('layouts.common')

@section('css', asset('css/product/index.css'))
@section('title', '商品頁')

@section('content')
<div id="productIndex">
  <template v-if="products.length">
    <a :href="'/product/detail/' + product.id" v-for="product in products" :key="product.id">
      <div class="product-outer">
        <div id="product-frame">
          <p id="product-title"><b>@{{ product.title }}</b></p>
          <div id="product-picture"><img :src="product.img"></div>
          <div id="product-desc"><span>@{{ product.description }}</span></div>
          <p id="product-price"><span>$@{{ product.price }}</span></p>
        </div>
      </div>
    </a>
  </template>

  <template v-else>
    <div id="no-products"><i>@{{ this.params.keyWord ? '查無相關關鍵字 ' + this.params.keyWord : '尚無資料...' }}</i></div>
  </template>

  <div id="load-products">
    <template v-if="more">
      <div id="more-product" @click="load()">
        <span>更多商品...</span>
      </div>
    </template>
  </div>
</div>

@endsection

@section('script')
<script type="module" src="{{ asset('js/product/index.js') }}"></script>
@endsection
