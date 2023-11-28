import { createApp, ref } from 'vue';

const product = createApp({
  data() {
    return {
      params: {
        keyWord: null,
        offset: 0,
      },
      products: [],
      more: false
    }
  },
  mounted() {

  },
  created() {
    this.params.keyWord = header.keyWord
    this.load()
  },
  methods: {
    load() {
      axios.get(url('api/product'), {
        params: this.params
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
}).mount('#productIndex')
