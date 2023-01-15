<template>
  <Nav />
  <div class="flex flex-col items-center py-5">
    <h1 class="text-4xl font-bold text-white">NOS PRODUITS</h1>

    <div class="grid grid-cols-4 gap-4 py-10" >
      <div v-for="p in products">
        <ProductCard :product="p" />
      </div>
    </div>
  </div>

</template>

<script>
import ProductCard from '../components/ProductCard.vue'
import Nav from "../components/Nav.vue";
export default {
  components: {ProductCard, Nav},
  created() {
    this.axios.get('https://127.0.0.1:8000/product/list')
        .then((response) => {
          this.products = response.data.products;
        })
  },
  data(){
    return {
      name: "App",
      hello : 'cool petit nayo',
      products : [],
      panier : [],
    }
  },
  methods: {
    bonjour(){
      this.hello = "kiese ";
    }
  }
}
</script>

<style scoped>

</style>