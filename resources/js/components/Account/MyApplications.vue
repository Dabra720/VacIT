<script setup>
import { onMounted, ref, inject } from 'vue'

const user = inject('user')
const joboffers = ref([])

onMounted(async () => {
  get_joboffers()
})

const get_joboffers = async () => {
  let response = await axios.get(`/api/my_joboffers?id=${user.value.id}`)
  console.log('response', response)
  joboffers.value = response.data.joboffers
}
</script>
<template>
  <div class="container">
    <h1>Mijn Sollicitaties</h1>
    <div class="row">
      <div class="col">DATUM</div>
      <div class="col">TITEL</div>
      <div class="col">NIVEAU</div>
      <div class="col">UITGENODIGD</div>
    </div>
    <div class="row" v-for="offer in joboffers" :key="offer.id">
      <div class="col">{{ offer.date }}</div>
      <div class="col">{{ offer.title }}</div>
      <div class="col">{{ offer.level }}</div>
      <div class="col">{{ offer.pivot.invited }}</div>
    </div>
  </div>
</template>