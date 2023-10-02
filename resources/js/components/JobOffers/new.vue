<script setup>
import { ref } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router';

const router = useRouter()
const store = useStore()

const user = store.state.auth.user

const form = ref({
  title: '',
  date: '',
  level: '',
  description: '',
  company_id: user.company_id
})

const errors = ref({})

const save = () => {
  axios.post('/api/joboffer/create', form.value).then((response)=>{
    // alert('Vacature aangemaakt!', response)
    router.push(`/joboffer/details/${response.data.joboffer.id}`)
  }).catch((err)=>{
    // console.log(err)
    if(err.response.status == 422){
      errors.value = err.response.data.errors
    }else{
      alert('Daar ging iets fout..')
    }
  })
}

</script>
<template>
  <div class="container">
    <div class="row py-5">
      <div class="col-3">
        <!-- Company picture -->
      </div>
      <div class="col-9">
        <h1>Maak hier uw nieuwe vacature</h1>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="title">Titel</label>
              <input class="form-control" id="title" type="text" v-model="form.title">
              <div class="text-danger" v-if="errors.title">{{ errors.title[0] }}</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="date">Datum</label>
              <input class="form-control" id="date" type="date" v-model="form.date">
              <div class="text-danger" v-if="errors.date">{{ errors.date[0] }}</div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="level">Niveau</label>
              <select id="level" class="form-control" v-model="form.level">
                <option disabled value="" selected>Kies een niveau</option>
                <option value="Junior">Junior</option>
                <option value="Medior">Medior</option>
                <option value="Senior">Senior</option>
              </select>
              <div class="text-danger" v-if="errors.level">{{ errors.level[0] }}</div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="description">Beschrijving</label>
              <textarea id="description" class="form-control" v-model="form.description"/>
              <div class="text-danger" v-if="errors.description">{{ errors.description[0] }}</div>
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