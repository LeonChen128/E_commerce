import { header, header_params } from '../app';
import { getParameterByName } from '../core';

const app = createApp({
  data() { 
    return {
      ...header_params.data,
      params: {
        keyword: '',
        offset: 0
      },
      products: [],
      more: false,
    }
  },
  mounted() {
    this.$nextTick(() => {
      // 點擊 sidebar 以外區域關閉 sidebar
      window.addEventListener('click', this.closeSidebarOnClickOutside);
    });

    this.params.keyword = getParameterByName('keyword') ?? '';

    // this.cartCount = 12
    // this.user = {}
    this.load()
  },
  created() {

  },
  methods: {
    ...header_params.methods,
    closeSidebarOnClickOutside(event) {
      const domHamburger = this.$refs.header.$refs.hamburger;
      const domSidebar = this.$refs.header.$refs.sidebar;

      if (domHamburger.contains(event.target)) {
        return true;
      }

      if (!domSidebar.contains(event.target)) {
        this.sidebarActive = false;
      }
    },
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
