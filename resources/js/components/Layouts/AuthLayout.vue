<script setup>
import { inject, ref, watchEffect } from 'vue';
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'

const router = useRouter()
const store = useStore()

// const user = inject('user')
const user = store.state.auth.user
// const isAuth = store.state.auth.authenticated

// const refreshKey = ref(0)

// watchEffect(user, () => {
//     console.log('user changed')
//     forceRerender()
// })

// const forceRerender = () => {
//     refreshKey.value += 1;
// };

const signOut = () => store.dispatch('auth/logout')

const logout = async () => {
    await axios.post('/api/logout')
    // user.value = null;
    signOut()

    router.push({ name: "Login"})
}

</script>
<template>
  <header>
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
                      <li class="nav-item" v-if="user.role != 1">
                          <router-link to="/dashboard" class="nav-link">Mijn profiel</router-link>
                      </li>
                      <li class="nav-item" v-if="user.role == 3">
                          <router-link to="/applications" class="nav-link">Mijn sollicitaties</router-link>
                      </li>
                      <li class="nav-item" >
                        <a class="nav-link" @click="logout">Log uit</a>
                      </li>
                    </ul>
                </div>
            </div>
        </nav>
  </header>
  
  <!-- Main content -->
  <section class="auth-layout">
    <router-view/>
  </section>

  <footer class="footer border-top text-light bg-dark">
    <div class="container-fluid">
      <router-link to="/" class="navbar-brand">
        <!-- <img src="~/assets/vacit-logo-wit-crop.png" height="120" /> -->
      </router-link>
      &copy; 2023 - Vac_T - <router-link to="/">Privacy</router-link>
    </div>
  </footer>
  
</template>