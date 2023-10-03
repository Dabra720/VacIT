<script setup>
import { ref, onMounted } from 'vue'
import { useStore } from 'vuex'

const store = useStore()

const user = store.state.auth.user

const timeslots = ref([])

onMounted(async () => {
  getTimeslots()
})

const getTimeslots = async () => {
  let response = await axios.get(`/api/timeslots/company/${company_id}`)
  timeslots.value = response.data.appointments
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
            <select class="form-control">
              <option v-for="slot in timeslots" :value="slot.id">{{ slot.date + " " + slot.start }}</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <button @click.prevent="save" type="submit" class="btn btn-primary my-2">Sla op</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>