<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router';
import { useStore } from 'vuex'

const router = useRouter()
const store = useStore()
const user = store.state.auth.user

const props = defineProps(['id'])

const timeslots = ref([])
const appointment = ref({
  slot: '',
  user: user.id,
})

onMounted(async () => {
  console.log('props', props.id)
  getTimeslots()
})

const getTimeslots = async () => {
  let response = await axios.get(`/api/timeslots/company/${props.id}`)
  timeslots.value = response.data.timeslots
}

const save = () => {
  axios.post(`/api/appointment/add`, appointment.value).then(res=>{
    console.log(res)
    alert('Afspraak gemaakt!')
    router.push({name:'Home'})
  }).catch(err=>{
    console.log(err)
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
          <h1>Je bent uitgenodigd voor een gesprek!</h1>
        </div>

        <div class="row">
          <h2>Kies een tijdslot</h2>
          <div class="form-group">
            <label for="timeslot">Tijdslot</label>
            <select class="form-control" v-model="appointment.slot">
              <option v-for="slot in timeslots" :value="slot.id">
                {{ slot.date + " | " + slot.start + " | " +  slot.duration + " minuten | " + (slot.online?"Online":"Op locatie")}}
              </option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <button @click.prevent="save" type="submit" class="btn btn-primary my-2">Maak afspraak</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>