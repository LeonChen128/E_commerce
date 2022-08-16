
@extends('layouts.common')

@section('css', '/asset/css/cart/index.css')
@section('title', '購物車頁面')

@section('content')

<div id="cart">
  <template v-if="products.length">
    <table>
      <tr>
        <th>移除</th>
        <th colspan="2">商品資訊</th>
        <th>單價</th>
        <th>數量</th>
        <th>小記</th>
      </tr>
      <tr v-for="product in products" :key="product.id">
        <td><p @click="remove(product.id)" class="trash-can"><i class="fas fa-trash-alt"></i></p></td>
        <td><p><a :href="'/product/detail/' + product.id"><img :src="product.img"></a></p></td>
        <td><p>@{{ product.title }}</p></td>
        <td><p>@{{ '$' + product.price }}</p></td>
        <td><select v-model="product.count" @change="calculateTotalPrice">
          <option v-for="(count, index) in product.total" :key="index"
            :value="count" :selected="product.count == count">@{{count}}</option>
        </select></td>
        <td><p>$@{{ product.price * product.count }}</p></td>
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
      products: [],
      total: 0,
    },
    created() {
      this.products = Data.get('products') ?? []
      this.calculateTotalPrice()
    },
    methods: {
      remove(id) {
        this.products = this.products.filter(product => product.id != id )
        Data.set('products', this.products)
        this.calculateTotalPrice()
        header.calculateCartCount()
      },
      calculateTotalPrice() {
        this.products.forEach(product => this.total += product.price * product.count)
      },
      buy() {
        if (!header.user) {
          header.showAuthTable(0, { type: 'notice', msg: '請先登入' })
          return false
        }

        if (!this.products.length) return false

        $.ajax({
          method: "POST",
          data: {
            products: this.products.map(product => { return { id: product.id, count: product.count }})
          },
          dataType: "JSON",
          url: appUrl + '/api/order',
          beforeSend: _ => loading.show = true,
          complete: _ => loading.show = false,
          success: _ => {
            alert.success('訂單成立成功，即將返回首頁...')
            setTimeout(_ => header.redirectTo('product'), 1500)
            Data.del('products');
          },
          error: ({responseJSON}) => alert.fail(responseJSON.message)
        })
      }
    }
  })

</script>
@endsection
