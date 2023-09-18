<script setup>
import { inject, ref, watch } from 'vue';
import { useRouter } from 'vue-router'

const router = useRouter()

const user = inject('user')

const refreshKey = ref(0)

watch(user, () => {
    forceRerender()
})

const forceRerender = () => {
    refreshKey.value += 1;
};

const logout = async () => {
    await axios.post('/api/logout')
    router.push({ name: "Home"})
}

</script>
<template>
  <header :key="refreshKey">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <router-link class="navbar-brand" to="/">
                    Vac!T
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <template v-if="user">
                            <li class="nav-item" >
                              <a class="nav-link" @click="logout()">Log uit</a>
                            </li>

                        </template>
                        <template v-else>
                            <li class="nav-item">
                              <router-link to="/login" class="nav-link">Log in</router-link>
                            </li>
                            <li class="nav-item">
                              <router-link to="/register" class="nav-link">Registreer</router-link>
                            </li>

                        </template>
                    </ul>
                </div>
            </div>
        </nav>
  </header>
</template>
<!-- <script>
export default {
  data(){
      return{
          user: null
      }
  },
  methods:{
      logout(){
          axios.post('/api/logout').then(()=>{
              this.$router.push({ name: "Home"})
          })
      },
      getUser(){
        try {
            axios.get('/api/user').then((res)=>{
                this.user = res.data
                console.log(this.user);
            })
        } catch (error) {
            // No user / unauthorized
            console.log('error', error)
        }
      }
  },
  mounted(){
      this.getUser()
  }
}
</script> -->