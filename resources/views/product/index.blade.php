
@extends('layouts.common')

@section('css', asset('css/product/index.css'))
@section('title', '商品頁')

@section('content')
<div id="productIndex">
  <template v-if="products.length">
    <a :href="'/product/detail/' + product.id" v-for="product in products" :key="product.id" class="product-unit">
      <div>
        <p class="product-title"><b>@{{ product.title }}</b></p>
        <img :src="product.img">
        <div class="product-desc"><span>@{{ product.description }}</span></div>
        <p class="product-price"><span>$@{{ product.price }}</span></p>
      </div>
    </a>
  </template>

  <template v-else>
    <div id="noProducts"><i>@{{ this.params.keyWord ? '查無相關關鍵字 ' + this.params.keyWord : '尚無資料...' }}</i></div>
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
