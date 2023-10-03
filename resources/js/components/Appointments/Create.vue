<script setup>
import { ref, onMounted } from 'vue'
import { useStore } from 'vuex'
import Timeslot from './Timeslot.vue';

const store = useStore()

const user = store.state.auth.user

const timeslots = ref([
  {
    company_id: user.company_id,
    date: '',
    start: '',
    duration: '',
    online: '',
  }
])
const joboffers = ref([])

onMounted(async () => {
  getJoboffers()
})

const addSlot = () => {
  const slot = {
    company_id: user.company_id,
    date: '',
    start: '',
    duration: '',
    online: '',
  }
  timeslots.value.push(slot)
}

const getJoboffers = async () => {
  let response = await axios.get(`/api/get_joboffers?id=${user.company_id}`)
  joboffers.value = response.data.joboffers
}

const save = () => {
  console.log('Save', timeslots.value)
  axios.post('/api/timeslots/create', timeslots.value).then(response => {
    console.log('Appointments saved')
  }).catch(err=>{
    if(err.response.status == 403){
      console.log('unauthorized')
    }else{
      console.log('something went wrong')
    }
  })
}
</script>
<template>
  <div class="container">
    <div class="row">
      <div class="col-3">
  
      </div>
      <div class="col-9">
        <div class="row">
          <h1>Maak een tijdslot aan</h1>
        </div>

        <Timeslot :index="index" :timeslots="timeslots" :joboffers="joboffers" v-for="(slot, index) in timeslots"/>

        <div class="row">
          <div class="col d-flex justify-content-between">
            <button @click.prevent="save" type="submit" class="btn btn-primary my-2">Sla op</button>
            <button @click.prevent="addSlot" class="btn btn-primary my-2">Nieuw</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>