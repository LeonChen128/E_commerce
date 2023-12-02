import { header, app_params } from '../app';
import { getParameterByName } from '../core';

const app = createApp({
  data() { 
    return {
      ...app_params.data,
      params: {
        keyword: '',
        offset: 0
      },
      products: [],
      more: false,
    }
  },
  mounted() {
    this.init()

    this.params.keyword = getParameterByName('keyword') ?? '';

    // this.cartCount = 12
    // this.user = {}
    this.load()
  },
  created() {

  },
  methods: {
    ...app_params.methods,
    load() {
      let params = {}
      if (this.params.keyword) {
        params.keyword = this.params.keyword
      }

      params.offset = this.params.offset

      axios.get(url('api/product'), {
        params: params
      })
        .then(({ data }) => {
          this.products = this.products.concat(data.products)
          this.params.offset = data.offset
          this.more = data.more
        })
        .catch(error => {
          console.error(error)
        });
    }
  }
}).component('header-component', header).mount('#app')
