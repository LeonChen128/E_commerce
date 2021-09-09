
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
      count: 1,
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

      if (this.product.total == 0) {
        notice.fail = '目前已無庫存！'
      }
    },
    methods: {
      addCart() {
        if (this.count > this.product.total || this.count < 1) {
          notice.fail = '數量錯誤！'
          return false
        }

        let items = (tmp = JSON.parse(localStorage.getItem('items'))) ? tmp : []

        let repeat = 0
        let over = false
        items = items.map((item) => {
          if (item.product.id == this.product.id) {
            if (over = ((item.count + this.count) > this.product.total)) {
              notice.fail = (tmp = this.product.total - item.count) > 0
                ? '最多可以再購買 ' + tmp + ' 件！'
                : '購物車數量超過所剩數量！'
              return false
            }
            repeat++
            item.count += this.count
          }
          return item
        })

        if (over) { return false }
        if (!repeat) { items.push({ product: this.product, count: this.count }) }

        localStorage.setItem('items', JSON.stringify(items))

        notice.success = '商品加入成功！'
        
        header.calculateCartCount()
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