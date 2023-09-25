<script setup>
import { ref, inject, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'

const store = useStore()
// const user = inject('user')
const router = useRouter()

const user = store.state.auth.user

const form = ref({
  user_id: user.id,
  name: user.name,
  surname: '',
  date_of_birth: '',
  phone: '',
  address: '',
  postcode: '',
  city: ''

})

onMounted(async ()=>{
  if(user){
    getProfile(user.id);
  }
})

const save = async () => {
  await axios.post('api/profile/save', form.value)
  console.log('Profile saved')
  router.push('/dashboard')
}

const getProfile = async (id) => {
  let response = await axios.get(`api/profile/user?id=${id}`)
  console.log('profile', response.data)
  if(response.data.profile != null){
    form.value = response.data.profile
  }
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
          <div class="col-4">
            <div class="form-group">
              <label for="name">Voornaam</label>
              <input class="form-control" id="name" type="text" v-model="form.name">
            </div>
          </div>
          <div class="col-8">
            <div class="form-group">
              <label for="surname">Achternaam</label>
              <input class="form-control" id="surname" type="text" v-model="form.surname">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="email">E-mail</label>
              <input class="form-control" id="email" type="email" :value="user.email" disabled v-if="user">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <div class="form-group">
              <label for="date_of_birth">Geboortedatum</label>
              <input class="form-control" id="date_of_birth" type="date" v-model="form.date_of_birth">
            </div>
          </div>
          <div class="col-8">
            <div class="form-group">
              <label for="phone">Telefoonnummer</label>
              <input class="form-control" id="phone" type="text" v-model="form.phone">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="address">Adres</label>
              <input class="form-control" id="address" type="text" v-model="form.address">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <div class="form-group">
              <label for="postcode">Postcode</label>
              <input class="form-control" id="postcode" type="text" v-model="form.postcode">
            </div>
          </div>
          <div class="col-8">
            <div class="form-group">
              <label for="city">Woonplaats</label>
              <input class="form-control" id="city" type="text" v-model="form.city">
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