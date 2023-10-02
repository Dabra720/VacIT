<script setup>
import { onMounted, ref, inject } from 'vue'
import { useRouter } from 'vue-router';
import { useStore } from 'vuex'

const router = useRouter()
const store = useStore()

// const user = inject('user')
const user = store.state.auth.user
const joboffers = ref([])

onMounted(async () => {
  get_joboffers()
})

const get_joboffers = async () => {
  axios.get(`/api/my_joboffers?id=${user.id}`).then((response)=>{
    joboffers.value = response.data.joboffers
  }).catch(err => {
    if(err.response.status == 403){
      router.push({name: 'Unauthorized'})
    }
  })
  // let response = await axios.get(`/api/my_joboffers?id=${user.id}`)
  // console.log('response', response)
  // joboffers.value = response.data.joboffers
}
</script>
<template>
  <div class="container">
    <div class="row">
      <div class="col-3"></div>
      <div class="col-9">
        <h1 class="">Mijn Sollicitaties</h1>
        <div class="row">
          <div class="col"><span class="">DATUM</span></div>
          <div class="col"><span class="">VACATURE</span></div>
          <div class="col"><span class="">BEDRIJF</span></div>
          <div class="col"><span class="">UITGENODIGD</span></div>
        </div>
        <div class="row border-bottom p-1" v-for="offer in joboffers" :key="offer.id">
          <div class="col">{{ offer.date }}</div>
          <div class="col">{{ offer.title }}</div>
          <div class="col" v-if="offer.company">{{ offer.company.name }}</div>
          <div class="col">{{ offer.pivot.invited }}</div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
  
</style>