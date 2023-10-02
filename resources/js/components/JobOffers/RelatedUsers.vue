<script setup>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import moment from 'moment'

const router = useRouter()
const props = defineProps(['joboffer'])

const users = ref([]);

onMounted(async () => {
  // console.log('users mounting', props)
  if(props.joboffer){
    // console.log('joboffer f: ', props.joboffer)
    getRelatedUsers(props.joboffer.id)
  }
})

const format_date = (value) => {
  if (value) {
    return moment(String(value)).format('DD-MM-YYYY')
  }
}

const getRelatedUsers = async (id) => {
  axios.get("/api/joboffer/get_candidates?id="+id).then((response)=>{
    users.value = response.data.users
  }).catch(err=>{
    if(err.response.status == 403){
      router.push({name: 'Unauthorized'})
    }else{
      console.log('Error', err)
    }
  })
  // let response = await axios.get("/api/joboffer/get_candidates?id="+id)
  // users.value = response.data.users
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
  }).catch((err) => {
    if(err.response.status == 403){
      router.push({name: 'Unauthorized'})
    }
    console.log('Something went wrong')
  })
}

const show_profile = (id) => {
  console.log('/profile/'+id)
  router.push('/profile/'+id)
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
      <router-link to="#" @click="show_profile(user.id)">
        <span class="borange">{{ user.name }}</span>
      </router-link>
    </div>
    <div class="col-3">
      <input type="checkbox" @click="invite(user.id, user.pivot.invited)" :checked="user.pivot.invited">
    </div>
  </div>
</template>
<style>
</style>