<script setup>
import { useRouter } from 'vue-router'
const router = useRouter()
defineProps(['profile'])

const updateCompany = () => {
  router.push('/update/company')
}

</script>
<template>
  <div class="row py-4">
      <div class="col-3">
        <!-- Profile picture -->
      </div>
      <div class="col-9">
        <div class="d-flex justify-content-between">
          <div><h1>Mijn Bedrijf</h1></div>
          <div>
            <button @click="updateCompany" class="btn btn-primary">Wijzig profiel</button>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="name">Naam</label>
            <p id="name" class="borange">{{ profile.name }}</p>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="city">Locatie</label>
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