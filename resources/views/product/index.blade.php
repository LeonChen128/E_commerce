
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
    <div id="noProducts"><span>@{{ this.params.keyword ? '查無相關商品 「' + this.params.keyword + '」' : '尚無資料...' }}</span></div>
  </template>

  <template v-if="more">
    <div id="loadProducts">
      <div @click="load()">
        <span>更多商品...</span>
      </div>
    </div>
  </template>
</div>

@endsection

@section('script')
<script type="module" src="{{ asset('js/product/index.js') }}"></script>
@endsection
