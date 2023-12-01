import { getParameterByName } from '../core';
import { header, header_params } from '../app';

const app = createApp({
  data() {
    return {
      ...header_params.data,
      product: null
    }
  },
  mounted() {
    const urls = location.href.split('/')
    const id = urls[urls.length - 1]

    this.getDetail(id)
  },
  methods: {
    ...header_params.methods,
    getDetail(id) {
      axios.get(url('api/product/' + id))
        .then(({ data }) => {
          this.product = data
        })
        .catch(error => {
          console.error(error)
        });
    }
  }
}).component('header-component', header).mount('#app')

// const app = createApp({
//   data: {
//     product: null,
//     count: 1,
//     rest: 0
//   },
//   created() {
//     this.product = {
//       id: '{{ $product->id }}',
//       userId: '{{ $product->user_id }}',
//       title: '{{ $product->title }}',
//       description: '{{ $product->description }}',
//       category: '{{ $product->category }}',
//       price: Number('{{ $product->price }}'),
//       img: '{{ $product->img }}',
//       total: Number('{{ $product->total }}'),
//     }

//     this.rest = this.product.total

//     Array.isArray(products = Data.get('products')) && products.forEach(product => {
//       product.id == this.product.id && (this.rest -= product.count)
//     })

//     this.product.total == 0 && alert.fail('目前已無庫存！')
//   },
//   mounted() {
//     console.log(123)
//     // axios.get(url('api/product'), {
//     //     params: this.params
//     //   })
//     //     .then(({ data }) => {
//     //       this.products = this.products.concat(data.products)
//     //       this.params.offset = data.offset
//     //       this.more = data.more
//     //     })
//     //     .catch(error => {
//     //       console.error(error)
//     //     });
//   },
//   methods: {
//     addCart() {
//       if (this.rest <= 0) {
//         alert.fail('已無庫存！')
//         return
//       }

//       if (this.count < 1) {
//         alert.fail('數量不可低於 1')
//         return
//       }

//       if (this.count > this.rest) {
//         alert.fail('數量不可超過 ' + this.rest)
//         return
//       }

//       let exist = false
//       let products = (Data.get('products') ?? []).map(product => {
//         if (product.id == this.product.id) {
//           product.count += this.count
//           this.rest -= this.count
//           exist = true
//         }
//         return product
//       })

//       !exist && (this.product.count = this.count) && products.push(this.product)
//         && (this.rest -= this.count)

//       Data.set('products', products)

//       alert.success('商品加入成功！')
//       header.calculateCartCount()
//     },
//     decrease() {
//       this.count != 1 && this.count--
//     },
//     increase() {
//       this.count < this.rest && this.count++
//     }
//   }
// }).component('header-component', header).mount('#app')
