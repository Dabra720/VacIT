<script setup>
import { inject, ref, watchEffect } from 'vue';
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'

const router = useRouter()
const store = useStore()

// const user = inject('user')
const user = store.state.auth.user
const isAuth = store.state.auth.authenticated

const refreshKey = ref(0)

watchEffect(user, () => {
    console.log('user changed')
    forceRerender()
})

const forceRerender = () => {
    refreshKey.value += 1;
};

const signOut = () => store.dispatch('auth/logout')

const logout = async () => {
    await axios.post('/api/logout')
    // user.value = null;
    signOut()

    router.push({ name: "Login"})
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
                        <template v-if="isAuth">
                            <li class="nav-item" v-if="user.role_id != 1">
                                <router-link to="/dashboard" class="nav-link">Mijn profiel</router-link>
                            </li>
                            <li class="nav-item" v-if="user.role_id == 3">
                                <router-link to="/applications" class="nav-link">Mijn sollicitaties</router-link>
                            </li>
                            <li class="nav-item" >
                              <a class="nav-link" @click="logout">Log uit</a>
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
<style>
.nav-link{
    cursor:pointer;
}
</style>