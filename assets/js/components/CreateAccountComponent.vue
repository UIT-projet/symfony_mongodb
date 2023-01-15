<template>
  <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=green&shade=600" alt="Your Company">
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Creation du compte </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          <a href="#" class="font-medium text-green-600 hover:text-green-500">BioApp</a>
        </p>
      </div>
      <div class="mt-8 space-y-6">
        <input type="hidden" name="remember" value="true">
        <div class="-space-y-px rounded-md shadow-sm">
          <div>
            <label for="email-address" class="sr-only">Email address</label>
            <input v-model="data.tel" id="email-address" name="email" type="tel" autocomplete="email" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm" placeholder="Phone number">
          </div>
          <div>
            <label for="password" class="sr-only">Password</label>
            <input v-model="data.password" id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm" placeholder="Mot de passe">
          </div>
          <div>
            <label for="passwordc" class="sr-only">Password</label>
            <input v-model="data.cpassword" id="passwordc" name="passwordc" type="password" autocomplete="current-password" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm" placeholder="Confirmer mot de passse">
          </div>

          <div>
            <label for="nom" class="sr-only">Nom</label>
            <input v-model="data.noms" id="nom" name="nom" type="text" autocomplete="current-nom" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm" placeholder="Votre nom complet (ex : Nsuadi Glodi)">
          </div>

          <div>
            <label for="date" class="sr-only">Nom</label>
            <input v-model="data.datenaiss" id="date" name="nom" type="date" autocomplete="current-nom" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm" placeholder="Date de naissance">
          </div>

          <div>
            <label for="genre" class="sr-only">Nom</label>
            <select v-model="data.genre" id="genre" name="genre" type="text" autocomplete="current-genre" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-green-500 focus:outline-none focus:ring-green-500 sm:text-sm">
              <option>Choisir le genre</option>
              <option value="Masculin">Masculin</option>
              <option value="Feminin">Masculin</option>
            </select>
          </div>

        </div>



        <div>
          <button @click="connexion" type="button" class="group relative flex w-full justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <!-- Heroicon name: mini/lock-closed -->
            <svg class="h-5 w-5 text-green-500 group-hover:text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
            </svg>
          </span>
            Créer le compte
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
      name: "CreateAccountComponent",
      data : {
        noms : '',
        password : '',
        genre : '',
        cpassword : '',
        datenaiss : '',
        tel : ''
      }
    }
  },
  methods : {
    connexion(){
      if(this.data.cpassword == this.data.password){
        console.log(this.data, "==========")
        this.axios.post('https://localhost:8000/user/create', this.data)
            .then((response) => {
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
                //createToast('Utilisateur', 'Créé');
                this.toast("Création du compte reussie", {
                  position : POSITION.TOP_RIGHT,
                  type : TYPE.SUCCESS
                })
                this.$emit('create', 'success');
              }
              else{
                this.toast(result.message, {
                  position : POSITION.TOP_RIGHT,
                  type : TYPE.ERROR
                })
              }
            })
            .catch((err)=>{
              console.log(err);
            })
      }
    }
  }
}
</script>

<style scoped>

</style>