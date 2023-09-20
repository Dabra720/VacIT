<script setup>
import RelatedJoboffers from './RelatedJoboffers.vue';
import RelatedUsers from './RelatedUsers.vue';
import { onMounted, ref, inject } from 'vue'

const user = inject('user')

const form = ref(null)

const props = defineProps(['id'])

onMounted(async () => {
  getJoboffer()
  
})

const getJoboffer = async () => {
  let response = await axios.get(`/api/show_joboffer/${props.id}`)
  // console.log('joboffer', response.data)
  form.value = response.data.joboffer
  // getCompanyJoboffers(response.data.joboffer.company_id)
}



</script>
<template>
  <div class="container">
    <div class="row">
      <aside class="col-md-2">
        <!-- Hier komt een image van het bedrijf -->
      </aside>
      <main class="col-md-10">
        <div class="row" >
          <h5>{{ form.date }}</h5>
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

    <div class="row" v-if="user">
      <div class="col-md-2">
        
      </div>
      <div class="col-10" v-if="user.role == 3">
        <a href="#" style="color: orangered;">SOLLICITEER DIRECT</a>
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