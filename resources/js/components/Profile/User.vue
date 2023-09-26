<script setup>
import {ref, onMounted} from 'vue'
import {useRouter} from 'vue-router'

const props = defineProps(['profile', 'user'])

const router = useRouter()

const invites = ref([])

onMounted(()=>{
  getInvites()
})

const getInvites = async () => {

  let response = await axios.get('/api/my_invites?id='+props.user.id)
  console.log('invites: ', response.data)
  invites.value = response.data.joboffers
}

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
  <div class="row">
    <div class="col-3"></div>
    <div class="col-9">
      <h1>Alle uitnodigingen</h1>
      <div class="row">
        <div class="col"><h4>Datum</h4></div>
        <div class="col"><h4>Vacature</h4></div>
        <div class="col"><h4>Bedrijf</h4></div>
      </div>
      <div class="row" v-for="offer in invites" :key="offer.id">
        <div class="col"><p>{{offer.date}}</p></div>
        <div class="col"><p>{{offer.title}}</p></div>
        <div class="col"><p v-if="offer.company">{{offer.company.name}}</p></div>
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