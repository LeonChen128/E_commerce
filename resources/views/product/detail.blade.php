
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
            <input type="number" v-model.number="count" min="1" max="{{ $product->total }}">
            <button type="button" @click="increase">＋</button>
          </div>
          <template v-if="rest !== null">
            <span id="count-rest">還剩 @{{ rest }} 件</span>
          </template>
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
      count: 1,
      rest: null
    },
    created() {
      this.product = {
        id: '{{ $product->id }}',
        userId: '{{ $product->user_id }}',
        title: '{{ $product->title }}',
        description: '{{ $product->description }}',
        category: '{{ $product->category }}',
        price: Number('{{ $product->price }}'),
        img: '{{ $product->img }}',
        total: Number('{{ $product->total }}'),
      }

      this.rest = this.product.total

      Array.isArray(products = Data.get('products')) && products.forEach(product => {
        product.id == this.product.id && (this.rest -= product.count)
      })

      this.product.total == 0 && alert.fail('目前已無庫存！')
    },
    methods: {
      addCart() {
        if (this.rest <= 0) {
          alert.fail('已無庫存！')
          return
        }

        if (this.count < 1) {
          alert.fail('數量不可低於 1')
          return
        }

        if (this.count > this.rest) {
          alert.fail('數量不可超過 ' + this.rest)
          return
        }

        let exist = false
        let products = (Data.get('products') ?? []).map(product => {
          if (product.id == this.product.id) {
            product.count += this.count
            this.rest -= this.count
            exist = true
          }
          return product
        })

        !exist && (this.product.count = this.count) && products.push(this.product)
          && (this.rest -= this.count)

        Data.set('products', products)

        alert.success('商品加入成功！')
        header.calculateCartCount()
      },
      decrease() {
        this.count != 1 && this.count--
      },
      increase() {
        this.count < this.rest && this.count++
      }
    }
  })
</script>
@endsection