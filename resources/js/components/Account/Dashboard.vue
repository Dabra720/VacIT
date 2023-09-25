<script setup>
import { ref, inject, onMounted } from 'vue'
import { useStore } from 'vuex'
import CompanyProfile from '../Profile/Company.vue'
import UserProfile from '../Profile/User.vue'
import UpdateProfile from '../Profile/Update.vue'

const store = useStore()

// const user = inject('user')
const user = store.state.auth.user
// const profile = ref('')
let profile = ref(null)
// let company = ref(null)

onMounted(async () => {

  console.log('user: ', user)
  if(user){
    if(user.role == 2){
        // profile.value = 'employer'
        await getCompany(user.company_id)
    }
    if(user.role == 3){
        // profile.value = 'user'
        await getProfile(user.id)
    }
  }
})

const getProfile = async (id) => {
  let response = await axios.get(`api/profile/user?id=${id}`)
  console.log('profile', response.data)
  profile.value = response.data.profile
}

const getCompany = async (id) => {
    console.log(`id: ${id}`)
  let response = await axios.get(`api/profile/company?id=${id}`)
  console.log('company', response.data)
  profile.value = response.data.company
}

</script>
<template>
  <div class="container" v-if="profile">
    <UserProfile v-if="user.role == 3" :profile="profile" :user="user"/>
    <CompanyProfile v-if="user.role == 2" :profile="profile"/>
  </div>
  <div class="container" v-else>
    <UpdateProfile />
  </div>
</template>

