import { getParameterByName } from '../core';
import { header, header_params } from '../app';

const app = createApp({
  data() { 
    return {
      ...header_params.data,
      params: {
        keyword: getParameterByName('keyword'),
        offset: 0,
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

    console.log(getParameterByName('keyword'))

    this.cartCount = 12
    // this.user = {}
  },
  created() {
    // this.params.keyword = header.keyword
    this.load()
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
}).component('header-component', header).mount('#app')
