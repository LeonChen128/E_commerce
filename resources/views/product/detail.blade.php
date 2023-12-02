
@extends('layouts.common')

@section('css', url('css/product/detail.css'))
@section('title', '商品詳細頁')

@section('content')
<div id="productDetail">
  <template v-if="product">
    <div>
      <img :src="product.img">
    </div>

    <div>
      <div id="title"><b>@{{ product.title }}</b></div>

      <div id="desc"><span>@{{ product.description }}</span></div>
      
      <div id="price"><b>$@{{ product.price }}</b></div>

      <div id="category"><span>分類：@{{ product.category }}</span></div>
      
      <div id="date"><span>更新日期：@{{ product.date }}</span></div>
      
      <div id="purchase">
        <form @submit.prevent="addCart">
          <div id="countBarFrame">
            <span>數量：</span>

            <div id="countBar">
              <button type="button" @click="count != 1 && count--">－</button>
              <input type="number" v-model.number="count" min="1" :max="product.total">
              <button type="button" @click="count < rest && count++">＋</button>
            </div>

            <template v-if="rest !== null">
              <span id="count-rest">還剩 @{{ rest }} 件</span>
            </template>
          </div>

          <button id="buy-btn">加入購物車</button>
        </form>
      </div>
    </div>
  </template>
</div>
@endsection

@section('script')
<script type="module" src="{{ asset('js/product/detail.js') }}"></script>
@endsection
