<template>
  <!-- This example requires Tailwind CSS v3.0+ -->
  <div class="isolate bg-white">
    <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]">
      <svg class="relative left-[calc(50%-11rem)] -z-10 h-[21.1875rem] max-w-none -translate-x-1/2 rotate-[30deg] sm:left-[calc(50%-30rem)] sm:h-[42.375rem]" viewBox="0 0 1155 678" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill="url(#45de2b6b-92d5-4d68-a6a0-9b9b2abad533)" fill-opacity=".3" d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z" />
        <defs>
          <linearGradient id="45de2b6b-92d5-4d68-a6a0-9b9b2abad533" x1="1155.49" x2="-78.208" y1=".177" y2="474.645" gradientUnits="userSpaceOnUse">
            <stop stop-color="#9089FC"></stop>
            <stop offset="1" stop-color="#FF80B5"></stop>
          </linearGradient>
        </defs>
      </svg>
    </div>
    <div class="px-6 pt-6 lg:px-8">
      <div>
        <nav class="flex h-9 items-center justify-between" aria-label="Global">
          <div class="flex lg:min-w-0 lg:flex-1" aria-label="Global">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Company</span>
              <img class="h-8" src="https://tailwindui.com/img/logos/mark.svg?color=green&shade=600" alt="">
            </a>
          </div>
          <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
              <span class="sr-only">Open main menu</span>
              <!-- Heroicon name: outline/bars-3 -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
              </svg>
            </button>
          </div>
          <div class="hidden lg:flex lg:min-w-0 lg:flex-1 lg:justify-center lg:gap-x-12">
            <a href="#" class="font-semibold text-gray-900 hover:text-gray-900">Accueil</a>

            <a href="#" class="font-semibold text-gray-900 hover:text-gray-900">Legumes feuilles</a>

            <a href="#" class="font-semibold text-gray-900 hover:text-gray-900">Legumes fruits</a>

            <a href="#" class="font-semibold text-gray-900 hover:text-gray-900">Fruits</a>
          </div>
          <div class="relative ml-3 hidden lg:flex lg:min-w-0 lg:flex-1 lg:justify-end gap-4">
            <div class="hidden lg:flex lg:min-w-0 lg:flex-1 lg:justify-end gap-4" v-if="!store.user">
              <a href="#" class="inline-block rounded-lg px-3 py-1.5 text-sm font-semibold leading-6 text-gray-900 shadow-sm ring-1 ring-gray-900/10 hover:ring-gray-900/20" @click="aff_account(true)">Connxion</a>
              <a href="#" class="inline-block rounded-lg px-3 py-1.5 text-sm font-semibold leading-6 text-gray-900 shadow-sm ring-1 ring-gray-900/10 hover:ring-gray-900/20" @click="aff_account()">Créer un compte</a>
            </div >
            <div class="absolute right-0 z-10 mt-10 px-5 w-96 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none animate__animated animate__backInDown" v-show="menu_account">
              <!--Formulaires pour la connexion et l'enregistrement-->
              <div class="" v-if="login">
                <LoginComponent v-on:login="onLogin" />
              </div>
              <div class="" v-if="create">
                <CreateAccountComponent v-on:create="onLogin" />
              </div>
            </div>
          </div>
          <div v-if="store.user" class="flex gap-4 justify-center items-center">
            <p >{{ store.noms }}</p>
<!--text-white bg-blue-700            -->
            <button @click="menu_panier=!menu_panier" type="button" class="relative inline-flex items-center p-3 text-sm font-medium text-center  rounded-lg ">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
              </svg>
              <div v-if="store.panier.length > 0" class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-green-500  rounded-full -top-0 -right-0 dark:border-gray-900"> {{ store.panier.length }} </div>
            </button>
            <div v-if="menu_panier" class="animate__animated animate__backInDown w-96 p-5 shadow-lg rounded bg-gray-50 absolute top-20 right-5" style="z-index: 10000">
              <div class="flex justify-between border-b pb-3 border-green-200">
                <p>Mon panier</p>
                <button type="button" class="hover:text-green-500 cursor-pointer" @click="menu_panier=false">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </button>
              </div>
              <div class="py-5">

                <div class="w-full max-w-md p-4 bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700" v-if="store.panier.length > 0">
                  <div class="flex items-center justify-between mb-4">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Produits</h5>
                    <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-green-500">
                      Total : {{ total() }} DT
                    </a>
                  </div>
                  <div class="flow-root">
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                      <li class="py-3 sm:py-4" v-for="pro in store.panier">
                        <div class="flex items-center space-x-4">
                          <div class="flex-shrink-0 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                            </svg>

                          </div>
                          <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                              {{pro.nom}}
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                              DT {{pro.prix}} x {{pro.qte}} = {{pro.prix * pro.qte}}
                            </p>
                          </div>
                          <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                            <button @click="add(pro._id)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                              </svg>

                              <span class="sr-only">Icon description</span>
                            </button>
                            <button @click="retrance(pro._id)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                              </svg>

                              <span class="sr-only">Icon description</span>
                            </button>
                          </div>
                        </div>
                      </li>
                    </ul>
                    <div class="py-4">
                      <button class="bg-green-500 text-white font-bold p-2 w-full" @click="commander">Commander</button>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <div class="relative ml-3"  v-if="store.user">
            <div>
              <button type="button" class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" @click="menu_user = !menu_user">
                <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
              </button>
            </div>

            <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none animate__animated animate__backInDown" v-show="menu_user">
              <!-- Active: "bg-gray-100", Not Active: "" -->
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Mon Profile</a>
              <a @click="logOut" href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Deconnexion</a>
            </div>
          </div>
        </nav>
        <!-- Mobile menu, show/hide based on menu open state. -->
        <div role="dialog" aria-modal="true">
          <div focus="true" class="fixed inset-0 z-10 overflow-y-auto bg-white px-6 py-6 lg:hidden">
            <div class="flex h-9 items-center justify-between">
              <div class="flex">
                <a href="#" class="-m-1.5 p-1.5">
                  <span class="sr-only">BioApp</span>
                  <img class="h-8" src="https://tailwindui.com/img/logos/mark.svg?color=green&shade=600" alt="">
                </a>
              </div>
              <div class="flex">
                <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                  <span class="sr-only">Close menu</span>
                  <!-- Heroicon name: outline/x-mark -->
                  <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>
            <div class="mt-6 flow-root">
              <div class="-my-6 divide-y divide-gray-500/10">
                <div class="space-y-2 py-6">
                  <a href="#" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Accueil</a>

                  <a href="#" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Legumes feuilles</a>

                  <a href="#" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Legumes fruits</a>

                  <a href="#" class="-mx-3 block rounded-lg py-2 px-3 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-400/10">Fruits</a>
                </div>
                <div class="py-6 ">
                  <a href="#" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-6 text-gray-900 hover:bg-gray-400/10">Connexion</a>
                  <a href="#" class="-mx-3 block rounded-lg py-2.5 px-3 text-base font-semibold leading-6 text-gray-900 hover:bg-gray-400/10">Creer un compte</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <main>
      <div class="relative px-6 lg:px-8">
        <div class="mx-auto max-w-3xl pt-20 pb-32 sm:pt-48 sm:pb-40">
          <div>
            <div class="hidden sm:mb-8 sm:flex sm:justify-center">
              <div class="relative overflow-hidden rounded-full py-1.5 px-4 text-sm leading-6 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
              <span class="text-gray-600">
                Reduction pour 5%, pour toute commande de ce mois <a href="#" class="font-semibold text-green-600"><span class="absolute inset-0" aria-hidden="true"></span>Read more <span aria-hidden="true">&rarr;</span></a>
              </span>
              </div>
            </div>
            <div>
              <h1 class="text-4xl font-bold tracking-tight sm:text-center sm:text-6xl">Commande du Bio à partir de chez toi </h1>
              <p class="mt-6 text-lg leading-8 text-gray-600 sm:text-center">La meilleur plateforme de vente en ligne des produits alimentaires Bio au monde entier. Nous sommes là pour satisfaire vos besoins</p>
              <div class="mt-8 flex gap-x-4 sm:justify-center">
                <a href="#" class="inline-block rounded-lg bg-green-600 px-4 py-1.5 text-base font-semibold leading-7 text-white shadow-sm ring-1 ring-green-600 hover:bg-green-700 hover:ring-green-700">
                  Se connecter
                  <span class="text-green-200" aria-hidden="true">&rarr;</span>
                </a>
                <a href="#" class="inline-block rounded-lg px-4 py-1.5 text-base font-semibold leading-7 text-gray-900 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                  Créer un compte
                  <span class="text-gray-400" aria-hidden="true">&rarr;</span>
                </a>
              </div>
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]">
              <svg class="relative left-[calc(50%+3rem)] h-[21.1875rem] max-w-none -translate-x-1/2 sm:left-[calc(50%+36rem)] sm:h-[42.375rem]" viewBox="0 0 1155 678" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="url(#ecb5b0c9-546c-4772-8c71-4d3f06d544bc)" fill-opacity=".3" d="M317.219 518.975L203.852 678 0 438.341l317.219 80.634 204.172-286.402c1.307 132.337 45.083 346.658 209.733 145.248C936.936 126.058 882.053-94.234 1031.02 41.331c119.18 108.451 130.68 295.337 121.53 375.223L855 299l21.173 362.054-558.954-142.079z" />
                <defs>
                  <linearGradient id="ecb5b0c9-546c-4772-8c71-4d3f06d544bc" x1="1155.49" x2="-78.208" y1=".177" y2="474.645" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#9089FC"></stop>
                    <stop offset="1" stop-color="#FF80B5"></stop>
                  </linearGradient>
                </defs>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>

</template>

<script>

import LoginComponent from "./LoginComponent.vue";
import CreateAccountComponent from "./CreateAccountComponent.vue";
import { store } from "../store";
import { useToast, POSITION, TYPE } from "vue-toastification";
export default {
  components : {LoginComponent, CreateAccountComponent},
  setup(){
    const toast = useToast();
    return { toast }
  },
  created() {
    if(localStorage.panier){
      this.store.panier = JSON.parse(localStorage.panier);
    }
    if(localStorage.user){
      this.store.user = localStorage.user;
      this.store.noms = localStorage.noms;
      console.log(localStorage.noms)
    }
  },
  data(){
    return{
      menu_user : false,
      menu_account : false,
      login : false,
      create : true,
      store,
      initTotal : 0,
      menu_panier : false
    }
  },
  methods : {
    //disconnect
    logOut(){
      localStorage.removeItem("noms");
      localStorage.removeItem("user");
      localStorage.removeItem("tel");
      localStorage.removeItem("adresse");
      localStorage.removeItem("id");
      localStorage.removeItem("datenaiss");
      this.store.noms = '';
      this.store.user = false;
      this.menu_user = false;
    },
    total(){
      let ctr  = 0;
      this.store.panier.forEach(el=>{
        ctr += el.qte * el.prix;
      })
      return ctr;
    },
    onLogin(){
      //listen login sucessfuly
      this.login = false;
      this.create = false;
      this.menu_account = false;
      this.store.user = true;
      this.store.noms = localStorage.noms;
    },
    aff_account(op = false){
      if(this.menu_account == false) this.menu_account = true;
      if(op == true) {
        this.create = false;
        if(this.login == true){
          this.login = false;
          this.menu_account = false;
        }
        else{
          this.login = true;
        }
      }
      else {
        this.login = false;
        if(this.create == true){
          this.create = false;
          this.menu_account = false;
        }
        else this.create = true;
      }
    },
    add(_id){

      if(this.store.panier.find(elm=> elm._id == _id)){
        for(let i = 0; i < this.store.panier.length; i++){
          if(this.store.panier[i]._id == _id){
            this.store.panier[i].qte += 1;
          }
        }
        localStorage.panier = JSON.stringify(this.store.panier);
      }
    },
    retrance(_id){
      if(this.store.panier.find(elm=> elm._id == _id)){
        for(let i = 0; i < this.store.panier.length; i++){
          if(this.store.panier[i]._id == _id){
            this.store.panier[i].qte -= 1;
            if(this.store.panier[i].qte == 0){
              this.store.panier.splice(i, 1);
              if(this.store.panier.length == 0) this.menu_panier = false;
            }
          }
        }
        localStorage.panier = JSON.stringify(this.store.panier);
      }
    },
    commander(){
      this.axios.post('https://127.0.0.1:8000/commander/'+localStorage.id, this.store.panier)
          .then((response)=>
          {
            this.toast("Commande enregistrée", {
              position : POSITION.TOP_RIGHT,
              type : TYPE.SUCCESS
            })
            this.store.panier = [];
            this.menu_panier = false;
            localStorage.panier = JSON.stringify(this.store.panier);
            console.log(response.data)
          }
          );
    }
  }
}
</script>

<style scoped>

</style>