<script setup>

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
                      <li class="nav-item">
                        <router-link to="/login" class="nav-link">Log in</router-link>
                      </li>
                      <li class="nav-item">
                        <router-link to="/register" class="nav-link">Registreer</router-link>
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