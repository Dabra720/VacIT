<script setup>
import { onMounted, ref } from 'vue'
import moment from 'moment'

const props = defineProps(['joboffer'])

const users = ref([]);

onMounted(async () => {
  console.log('users mounting', props)
  if(props.joboffer){
    console.log('joboffer f: ', props.joboffer)
    getRelatedUsers(props.joboffer.id)
  }

  

})

const format_date = (value) => {
  if (value) {
    return moment(String(value)).format('DD-MM-YYYY')
  }
}

const getRelatedUsers = async (id) => {
  console.log('id', id)
  let response = await axios.get("/api/joboffer/get_candidates?id="+id)
  console.log('related users', response)
  users.value = response.data.users
}

const invite = (user_id, invited) => {
  const body = {
    joboffer_id: props.joboffer.id,
    user_id: user_id,
    invited: !invited
  }
  axios.post('/api/joboffer/accept', body).then(() => {
    console.log('Candidate invited: ' + !invited)
    getRelatedUsers(props.joboffer.id)
  }).catch(() => {
    console.log('Something went wrong')
  })
}

</script>
<template>

  <h2>ALLE SOLLICITANTEN</h2>

  <div class="row">
    <div class="col-3">
      <h3>DATUM</h3>
    </div>
    <div class="col-6">
      <h3>NAAM</h3>
    </div>
    <div class="col-3">
      <h3>INTERESSE</h3>
    </div>
  </div>
  <div class="row border" v-for="user in users" :key="user.id">
    <div class="col-3 p-2 borange">
      <span class="borange">{{ format_date(user.pivot.created_at) }}</span>
    </div>
    <div class="col-6">
      {{ user.name }}
    </div>
    <div class="col-3">
      <input type="checkbox" @click="invite(user.id, user.pivot.invited)" :checked="user.pivot.invited">
    </div>
  </div>
</template>
<style>
</style>