
@extends('layouts.common')

@section('css', '/asset/css/cart/index.css')
@section('title', '購物車頁面')

@section('content')

<div id="cart">
  <template v-if="items.length">
    <div id="products-frame">
      <div v-for="item in items" :key="item.product.id">
        <p>商品：@{{ item.product.title }}</p>
        <p><img :src="item.product.img" width="60"></p>
        <p>數量：@{{ item.count }}</p>
        <button @click="remove(item.product.id)">移除</button>
      </div>
    </div>
  </template>
  <template v-else>
    <div>購物車尚無商品</div>
  </template>
</div>

@endsection

@section('script')
<script>
  let cart = new Vue({
    el: '#cart',
    data: {
      items: []
    },
    created() {
      this.items = Array.isArray(tmp = JSON.parse(localStorage.getItem('items'))) ? tmp : []
    },
    methods: {
      remove(id) {
        this.items.map((item, key) => {
          if (item.product.id == id) {
            this.items.splice(key, 1)
          }
        })

        localStorage.setItem('items', JSON.stringify(this.items))
      }
    }

  })

</script>
@endsection