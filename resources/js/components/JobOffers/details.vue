<script setup>
import { onMounted, ref } from 'vue'

let form = ref({ id: ''})
let company_joboffers = ref([]);

const props = defineProps({
  id:{
    type: String,
    default: ''
  }
})

onMounted(async () => {
  getJoboffer()
  
})

const getJoboffer = async () => {
  let response = await axios.get(`/api/show_joboffer/${props.id}`)
  // console.log('response', response)
  form.value = response.data.joboffer
  getCompanyJoboffers(response.data.joboffer.company_id)
}

const getCompanyJoboffers = async (id) => {
  let response = await axios.get("/api/get_joboffers?id="+id)
  // let response = await axios.get(`/api/company_joboffers/${id}`)
  // console.log('company joboffers', response.data.joboffers)
  company_joboffers.value = response.data.joboffers
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

    <div class="row">
      <div class="col-md-2">
        
      </div>
      <div class="col-10">
        <a href="#" style="color: orangered;">SOLLICITEER DIRECT</a>
        <h2>MEER VACATURES VAN {{ form.company.name }}</h2>
        <div class="row">
          <div class="col">
            <h3>DATUM</h3>
          </div>
          <div class="col">
            <h3>VACATURE</h3>
          </div>
          <div class="col">
            <h3>NIVEAU</h3>
          </div>
        </div>
        <div class="row" v-for="offer in company_joboffers" :key="offer.id">
          <div class="col">
            {{ offer.date }}
          </div>
          <div class="col">
            {{ offer.title }}
          </div>
          <div class="col">
            {{ offer.level }}
          </div>
        </div>
      </div>
    </div>

    
  </div>
</template>