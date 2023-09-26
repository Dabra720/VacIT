<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps(['id'])

const profile = ref(null)
const email = ref('')

onMounted(async () => {
  getProfile()
  getEmail()
})

const getProfile = async () => {
  console.log('Props',props)
  let response = await axios.get(`/api/profile/user?id=${props.id}`)
  profile.value = response.data.profile
}

const getEmail = async () => {
  let response = await axios.get(`/api/get_email?id=${props.id}`)
  email.value = response.data.email
}

</script>
<template>
  <div class="row py-5">
    <div class="col-3">
      <!-- Profile picture -->
    </div>
    <div class="col-9" v-if="profile">
      <div class="d-flex justify-content-between">
        <div><h1>{{profile.name}}'s Profiel</h1></div>
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
          <p id="email" class="borange">{{ email }}</p>
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