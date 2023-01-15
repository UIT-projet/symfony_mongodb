<template>
  <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=green&shade=600" alt="Your Company">
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Se connecter</h2>

      </div>
      <div class="mt-8 space-y-6">
        <input type="hidden" name="remember" value="true">
        <div class="-space-y-px rounded-md shadow-sm">
          <div>
            <label for="email-address" class="sr-only">Email glodi</label>
            <input v-model="data.tel" id="email-address" name="tel" type="tel" autocomplete="tel" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm" placeholder="Tel : 00-000-000">
          </div>
          <div>
            <label for="password" class="sr-only">Password</label>
            <input v-model="data.password" id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm" placeholder="Password">
          </div>
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
            <label for="remember-me" class="ml-2 block text-sm text-gray-900">Me rappeler</label>
          </div>

          <div class="text-sm">
            <a href="#" class="font-medium text-green-600 hover:text-green-500">Mot de passe oublié ?</a>
          </div>
        </div>

        <div>
          <button @click="login" type="button" class="group relative flex w-full justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <!-- Heroicon name: mini/lock-closed -->
            <svg class="h-5 w-5 text-green-500 group-hover:text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
            </svg>
          </span>
            Connexion
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import { useToast, POSITION, TYPE } from "vue-toastification";
export default {
  setup(){
    const toast = useToast();
    return { toast }
  },
  data(){
    return {
      name: "glodi",
      data : {
        tel : '',
        password : ''
      },
      user : false,
      loading : false,
    }
  },
  methods : {
    login(){
      this.loading = true;
      this.axios.post('https://localhost:8000/user/login', this.data)
          .then((response)=>{
            let result = response.data;
            console.log(result)
            if(result.status == true)
            {
              localStorage.id = result.message.id;
              localStorage.noms = result.message.noms;
              localStorage.tel = result.message.tel;
              localStorage.adresse = result.message.adresse;
              localStorage.datenaiss = result.message.datenaiss;
              this.loading = true;
              this.user = true;
              localStorage.user = true;
              //createToast('Utilisateur', 'Connecté');
              this.toast("Connexion reussie", {
                position : POSITION.TOP_RIGHT,
                type : TYPE.SUCCESS
              })
              this.$emit('login', 'success');
            }
            else{
              this.toast(result.message, {
                position : POSITION.TOP_RIGHT,
                type : TYPE.ERROR
              })
            }
          })
          .catch((err) =>{
            console.log(err)
          })
    }
  }
}
</script>

<style scoped>

</style>