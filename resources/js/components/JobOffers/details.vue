<script setup>
import RelatedJoboffers from './RelatedJoboffers.vue';
import RelatedUsers from './RelatedUsers.vue';
import { onMounted, ref, inject } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'

const router = useRouter()
const store = useStore()

// const user = inject('user')
const user = store.state.auth.user

const form = ref(null)

const props = defineProps(['id'])

onMounted(async () => {
  console.log('user', user)
  getJoboffer()
  
})

const getJoboffer = async () => {
  console.log(props)
  let response = await axios.get(`/api/show_joboffer/${props.id}`)
  // console.log('joboffer', response.data)
  form.value = response.data.joboffer
  // getCompanyJoboffers(response.data.joboffer.company_id)
}

const apply = () => {
  let body = {
    user_id: user.id,
    joboffer_id: form.value.id
  }
  console.log('body', body);
  axios.post('/api/joboffer/apply', body).then((res)=> {
    console.log('apply: ', res)
  }).catch((err)=>{
    console.log('error', err)
  })
}

const updateJoboffer = () => {
  router.push('/joboffer/update/'+form.value.id)
}
</script>
<template>
  <div class="container" v-if="form">
    <div class="row py-4">
      <aside class="col-md-2">
        <!-- Hier komt een image van het bedrijf -->
      </aside>
      <main class="col-md-10">
        <div class="row" >
          <div class="d-flex justify-content-between">
            <div><h5>{{ form.date }}</h5></div>
            <div v-if="user.role == 2">
              <button @click="updateJoboffer" class="btn btn-primary">Wijzig vacature</button>
            </div>
          </div>
          <h3 v-if="form.company">{{ form.title }} voor {{ form.company.name }}</h3>
        </div>
        <div class="row">
          <div class="col">
            <h4>NIVEAU: {{ form.level }}</h4>
          </div>
          <div class="col d-flex justify-content-end">
            <h4 v-if="form.company">LOCATIE: {{ form.company.city }}</h4>
          </div>
        </div>
        <div class="row">
          <p>{{ form.description }}</p>
        </div>
        
      </main>
    </div>

    <div class="row pb-4" v-if="user">
      <div class="col-md-2">
        
      </div>
      <div class="col-10" v-if="user.role == 3">
        <a @click="apply" class="apply">SOLLICITEER DIRECT</a>
        <!-- If Candidate: Related Joboffers -->
        <RelatedJoboffers v-if="form.company" :company="form.company"/>
      </div>
      <div class="col-10" v-if="user.role == 2">
        <!-- If Employer: Related Users -->
        <RelatedUsers v-if="form" :joboffer="form"/>
      </div>
    </div>

    
  </div>
</template>
<style>
.apply{
  color: orangeRed;
  font-size: xx-large;
}
</style>