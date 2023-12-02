import { getParameterByName, Data } from '../core';
import { header, app_params } from '../app';

const app = createApp({
  data() {
    return {
      ...app_params.data,
      product: null,
      count: 1,
      rest: 0,
    }
  },
  mounted() {
    this.init()
    const urls = location.href.split('/')
    const id = urls[urls.length - 1]

    this.getDetail(id)
  },
  methods: {
    ...app_params.methods,
    getDetail(id) {
      axios.get(url('api/product/' + id))
        .then(({ data }) => {
          this.product = data
          this.countRest()
        })
        .catch(error => {
          console.error(error)
        });
    },
    countRest() {
      let cart = Data.get('cart')
      let count = cart && typeof cart[this.product.id] !== 'undefined' ? cart[this.product.id] : 0
      this.rest = this.product.total - (count)
    },
    addCart() {
      let cart = Data.get('cart') ?? {}
      cart[this.product.id] = this.count + (cart[this.product.id] ?? 0)
      
      if (cart[this.product.id] > this.product.total) {
        return console.error('購買數量已達上限')
      }

      Data.set('cart', cart)
      this.countRest()
      this.refreshCartCount()
    }
  }
}).component('header-component', header).mount('#app')
