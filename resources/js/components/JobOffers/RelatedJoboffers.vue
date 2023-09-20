<script setup>
import { onMounted, ref } from 'vue'

const props = defineProps(['company'])

const company_joboffers = ref([]);

onMounted(async () => {
  if(props.company){
    console.log('company: ', props.company)
    getCompanyJoboffers(props.company.id)

  }
})

const getCompanyJoboffers = async (id) => {
  console.log('id', id)
  let response = await axios.get("/api/get_joboffers?id="+id)
  console.log('company joboffers', response)
  company_joboffers.value = response.data.joboffers
}

</script>
<template>

  <h2>MEER VACATURES VAN <span style="color: orangered;" v-if="company">{{ company.name }}</span></h2>

  <div class="row">
    <div class="col-3">
      <h3>DATUM</h3>
    </div>
    <div class="col-6">
      <h3>VACATURE</h3>
    </div>
    <div class="col-3">
      <h3>NIVEAU</h3>
    </div>
  </div>
  <div class="row" v-for="offer in company_joboffers" :key="offer.id">
    <div class="col-3">
      {{ offer.date }}
    </div>
    <div class="col-6">
      {{ offer.title }}
    </div>
    <div class="col-3">
      {{ offer.level }}
    </div>
  </div>
</template>