
@extends('layouts.common')

@section('css', '/asset/css/product/detail.css')
@section('title', '商品詳細頁')

@section('content')

<div id="detail">
  <div id="detail-main">
    <div id="detail-main-l">
      <img src="{{ $product->img }}">
    </div>
    <div id="detail-main-r">
      <p id="detail-title">
        <b>{{ $product->title }}</b>
      </p>
      <p id="detail-desc">
        <span>{{ $product->description }}</span>
      </p>
      <p id="detail-price">
        <b>${{ $product->price }}</b>
      </p>
      <p id="detail-category">
        <span>分類：{{ $product->category }}</span>
      </p>
      <p id="detail-date">
        <span>更新日期：{{ $product->date }}</span>
      </p>
      <p id="detail-purchase">
        <form @submit.prevent="addCart">
          <span>數量：</span>
          <div id="count-selector">
            <button type="button" @click="decrease">－</button>
            <input type="number" v-model="count" min="1">
            <button type="button" @click="increase">＋</button>
          </div>
          <span id="count-rest">還剩 {{ $product->total }} 件</span>
          <button id="buy-btn">加入購物車</button>
        </form>
      </p>
    </div>
  </div>
</div>

@endsection


@section('script')
<script>
  let detail = new Vue({
    el: '#detail',
    data: {
      product: null,
      count: 1
    },
    created() {
      this.product = {
        id: '{{ $product->id }}',
        userId: '{{ $product->user_id }}',
        title: '{{ $product->title }}',
        description: '{{ $product->description }}',
        category: '{{ $product->category }}',
        price: '{{ $product->price }}',
        img: '{{ $product->img }}',
      }
    },
    methods: {
      addCart() {
        let products = (tmp = JSON.parse(localStorage.getItem('products'))) ? tmp : []
        products.push({ product: this.product, count: this.count })
        localStorage.setItem('products', JSON.stringify(products))
      },
      decrease() {
        this.count != 1 && this.count--
      },
      increase() {
        this.count < "{{ $product->total }}" && this.count++
      }
    }
  })

</script>
@endsection