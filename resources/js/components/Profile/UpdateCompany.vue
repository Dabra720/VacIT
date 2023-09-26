<script setup>
import { ref, inject, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'

const store = useStore()
// const user = inject('user')
const router = useRouter()

const user = store.state.auth.user

onMounted(() => {
  console.log('user', user)
})

const form = ref({
  id: user.company_id,
  name: '',
  city: ''
})

onMounted(async ()=>{
  if(user){
    getCompany(user.company_id);
  }
})

const save = async () => {
  await axios.post('/api/company/update', form.value)
  console.log('Profile saved')
  router.push('/dashboard')
}

const getCompany = async (id) => {
  console.log(`id: ${id}`)
  let response = await axios.get(`/api/profile/company?id=${id}`)
  console.log('company', response.data)
  form.value = response.data.company
}

</script>
<template>
  <div class="container">
    <div class="row py-5">
      <div class="col-3">
        <!-- Profile picture -->
      </div>
      <div class="col-9">
        <h1>Wijzig Profiel</h1>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="name">Naam</label>
              <input class="form-control" id="name" type="text" v-model="form.name">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="city">Locatie</label>
              <input class="form-control" id="city" type="text" :value="form.city">
            </div>
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