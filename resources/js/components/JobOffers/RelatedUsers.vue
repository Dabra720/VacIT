<script setup>
import { onMounted, ref } from 'vue'

const props = defineProps(['joboffer'])

const users = ref([]);

onMounted(async () => {
  console.log('users mounting', props)
  if(props.joboffer){
    console.log('joboffer f: ', props.joboffer)
    getRelatedUsers(props.joboffer.id)

  }
})

const getRelatedUsers = async (id) => {
  console.log('id', id)
  let response = await axios.get("/api/joboffer/get_candidates?id="+id)
  console.log('related users', response)
  users.value = response.data.users
}

</script>
<template>

  <h2>ALLE SOLLICITANTEN</h2>

  <div class="row">
    <div class="col">
      <h3>DATUM</h3>
    </div>
    <div class="col">
      <h3>NAAM</h3>
    </div>
    <div class="col">
      <h3>INTERESSE</h3>
    </div>
  </div>
  <div class="row" v-for="user in users" :key="user.id">
    <div class="col">
      {{ user.pivot.created_at }}
    </div>
    <div class="col">
      {{ user.name }}
    </div>
    <div class="col">
      <input type="checkbox">
    </div>
  </div>
</template>