
@extends('layouts.common')

@section('css', '/asset/css/cart/index.css')
@section('title', '購物車頁面')

@section('content')

<div id="cart">
  <template v-if="items.length">
    <table>
      <tr>
        <th>移除</th>
        <th colspan="2">商品資訊</th>
        <th>單價</th>
        <th>數量</th>
        <th>小記</th>
      </tr>
      <tr v-for="item in items" :key="item.product.id">
        <td><p @click="remove(item.product.id)" class="trash-can"><i class="fas fa-trash-alt"></i></p></td>
        <td><p><a :href="'/product/detail/' + item.product.id"><img :src="item.product.img"></a></p></td>
        <td><p>@{{ item.product.title }}</p></td>
        <td><p>@{{ '$' + item.product.price }}</p></td>
        <td><select v-model="item.count" @change="calculateTotal">
          <option v-for="(count, index) in item.product.total" :key="index"
            :value="count" :selected="item.count == count"
          >@{{count}}</option>
        </select></td>
        <td><p>$@{{ item.product.price * item.count }}</p></td>
      </tr>
      <tr id="total-tr">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>總計</td>
        <td v-if="total">@{{ '$' + total }}</td>
      </tr>
    </table>
    <button id="buy-btn" @click="buy">結帳去</button>
  </template>
  <template v-else>
    <div id="no-cart">
      <span>購物車尚無商品...</span>
      <a href="/product">選購商品去 <i class="fas fa-shopping-basket"></i></a>
    </div>
  </template>
</div>

@endsection

@section('script')
<script>
  let cart = new Vue({
    el: '#cart',
    data: {
      items: [],
      total: 0,
    },
    created() {
      this.items = Array.isArray(tmp = JSON.parse(localStorage.getItem('items'))) ? tmp : []
      this.calculateTotal()
    },
    methods: {
      remove(id) {
        this.items.map((item, key) => {
          if (item.product.id == id) {
            this.items.splice(key, 1)
          }
        })

        localStorage.setItem('items', JSON.stringify(this.items))

        this.calculateTotal()
        header.calculateCartCount()
      },
      calculateTotal() {
        this.total = 0
        this.items.forEach((item) => {
          this.total += item.product.price * item.count
        })
      },
      buy() {
        if (!header.user) {
          authFrame.loginTable = true
          authFrame.notice = '請先登入！'
          return false
        }

        if (!localStorage.getItem('items')) { return false }

        let data = {
          products: this.items.map((item) => {
            return {
              id: item.product.id,
              count: item.count
            }
          })
        }

        $.ajax({
          method: "POST",
          data: data,
          dataType: "JSON",
          url: '{{ config("app.url") }}' + '/api/order',
          beforeSend: _ => {
            loading.show = true
          },
          complete: _ => {
            loading.show = false
          },
          success: _ => {
            notice.success = '訂單成立成功，即將返回首頁...'
            setTimeout(function() {
              window.location = '{{ config("app.url") }}/product'
            }, 1500)

            localStorage.removeItem('items');
          },
          error: ({responseJSON}) => {
            notice.fail = responseJSON.message
          }
        })
      }
    }

  })

</script>
@endsection