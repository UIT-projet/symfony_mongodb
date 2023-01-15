<template >
  <router-view></router-view>
</template>

<script>
import Nav from "./components/Nav.vue";
export default {
  components: {Nav},
  data(){
    return {
      name: "Cool",
    }
  },
  methods: {

  }
}
</script>