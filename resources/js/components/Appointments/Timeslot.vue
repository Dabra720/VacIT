<script setup>
const props = defineProps(['index', 'timeslots', 'joboffers'])

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

</script>
<template>
  <div class="card p-2 my-2">
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
        <select class="form-control" id="joboffer" v-model="timeslots[index].joboffer">
          <option value="" selected>Geen specifieke vacature</option>
          <option v-for="offer in joboffers" :value="offer.id">{{ offer.title }}</option>
        </select>
      </div>
    </div>
  </div>
</template>