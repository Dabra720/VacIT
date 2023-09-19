<script setup>
import {useRouter} from 'vue-router'
defineProps(['profile', 'user'])
const router = useRouter()

const updateProfile = () => {
  router.push('/updateprofile')
}

</script>
<template>
  <div class="row py-5">
    <div class="col-3">
      <!-- Profile picture -->
    </div>
    <div class="col-9">
      <div class="d-flex justify-content-between">
        <div><h1>Mijn Profiel</h1></div>
        <div>
          <button @click="updateProfile" class="btn btn-primary">Wijzig profiel</button>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <label for="name">Voornaam</label>
          <p id="name" class="borange">{{ profile.name }}</p>
        </div>
        <div class="col-8">
          <label for="surname">Achternaam</label>
          <p id="surname" class="borange">{{ profile.surname }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label for="email">E-mail</label>
          <p id="email" class="borange">{{ user.email }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <label for="date_of_birth">Geboortedatum</label>
          <p id="date_of_birth" class="borange">{{ profile.date_of_birth }}</p>
        </div>
        <div class="col-8">
          <label for="phone">Telefoonnummer</label>
          <p id="phone" class="borange">{{ profile.phone }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <label for="address">Adres</label>
          <p id="address" class="borange">{{ profile.address }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
          <label for="postcode">Postcode</label>
          <p id="postcode" class="borange">{{ profile.postcode }}</p>
        </div>
        <div class="col-8">
          <label for="city">Woonplaats</label>
          <p id="city" class="borange">{{ profile.city }}</p>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.borange{
  border-bottom: 1px solid;
  border-color:orangered;
  font-size:larger;
}

</style>