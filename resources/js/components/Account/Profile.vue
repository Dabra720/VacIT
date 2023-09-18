<script setup>
import { ref, inject, onMounted } from 'vue'

const user = inject('user')
let profile = ref(null)

onMounted(async () => {
  if(user.value){
    getProfile(user.value.id)

  }
})

const getProfile = async (id) => {
  let response = await axios.get(`api/profile?id=${id}`)
  // console.log('profile', response.data)
  profile.value = response.data.profile
}
</script>
<template>
  <div class="container">
    <div class="row">
      <div class="col-3">
        <!-- Profile picture -->
      </div>
      <div class="col-9">
        <h1>Mijn Profiel</h1>
        <div class="row">
          <div class="col">
            <p>Voornaam</p>
            <p>{{ profile.name }}</p>
          </div>
          <div class="col">
            <p>Achternaam</p>
            <p>{{ profile.surname }}</p>
          </div>
        </div>
        <div class="row">
          <p>E-mail</p>
          <p>{{ user.email }}</p>
        </div>
      </div>
    </div>
  </div>
</template>
<style>

</style>