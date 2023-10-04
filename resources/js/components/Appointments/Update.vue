<script setup>
import { ref, onMounted } from 'vue'
import { useStore } from 'vuex'
import Timeslot from './Timeslot.vue';

const store = useStore()

const user = store.state.auth.user

const timeslots = ref([])
const joboffers = ref([])
const duration = [
  {min: 15, show: '0:15'},
  {min: 30, show: '0:30'},
  {min: 45, show: '0:45'},
  {min: 60, show: '1:00'},
  {min: 75, show: '1:15'},
  {min: 90, show: '1:30'},
  {min: 105, show: '1:45'},
  {min: 120, show: '2:00'},
]

onMounted(async () => {
  getTimeslots()
  getJoboffers()
})

const addSlot = () => {
  const slot = {
    company_id: user.company_id,
    date: '',
    start: '',
    duration: '',
    online: '',
    joboffer_id: null,
  }
  timeslots.value.push(slot)
}

const getJoboffers = async () => {
  let response = await axios.get(`/api/get_joboffers?id=${user.company_id}`)
  joboffers.value = response.data.joboffers
}

const getTimeslots = async () => {
  let response = await axios.get(`/api/timeslots/company/${user.company_id}`)
  console.log('Timeslots: ', response.data.timeslots)
  timeslots.value = response.data.timeslots
}

const destroy = (id, index) => {
  axios.post(`/api/timeslots/delete?id=${id}`).then(() =>{
    timeslots.value.splice(index, 1)
  })
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

        <!-- <Timeslot :index="index" :timeslots="timeslots" :joboffers="joboffers" v-for="(slot, index) in timeslots"/> -->

        <div class="card p-2 my-2" v-for="(slot, index) in timeslots">
          <div class="row">
            <div class="form-group">
              <label for="date">Datum</label>
              <input class="form-control" id="date" type="date" v-model="timeslots[index].date">
            </div>
          </div>
          <div class="row">
            <div class="col form-group">
              <label for="start">Begintijd</label>
              <input class="form-control" id="start" type="time" v-model="timeslots[index].start">
            </div>
            <div class="col form-group">
              <label for="duration">Duur</label>
              <select class="form-control" id="duration" v-model="timeslots[index].duration">
                <option disabled value="" selected>Selecteer duur van het gesprek</option>
                <option v-for="time in duration" :value="time.min">{{ time.show }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="online">Locatie gesprek</label>
              <select class="form-control" id="online" v-model="timeslots[index].online">
                <option disabled value="" selected>Kies een locatie</option>
                <option value="1">Online</option>
                <option value="0">Op locatie</option>
              </select>
            </div>
            <div class="form-group">
              <label for="joboffer">Vacature</label>
              <select class="form-control" id="joboffer" v-model="timeslots[index].joboffer_id">
                <option :value="null" selected>Geen specifieke vacature</option>
                <option v-for="offer in joboffers" :value="offer.id">{{ offer.title }}</option>
              </select>
            </div>
            <div class="col-12 d-flex justify-content-end">
              <button class="btn btn-danger mt-2" @click="destroy(timeslots[index].id, index)">Verwijder</button>
            </div>
          </div>
        </div>

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