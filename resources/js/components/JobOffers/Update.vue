<script setup>
import { ref, onMounted } from 'vue'
import { useStore } from 'vuex'

const store = useStore()

const user = store.state.auth.user

const props = defineProps(['id'])

const form = ref({
  title: '',
  date: '',
  level: '',
  description: '',
  company_id: user.company_id
})

onMounted(() => {
  getJoboffer()
})

const getJoboffer = async () => {
  let response = await axios.get('/api/show_joboffer/'+props.id)
  form.value = response.data.joboffer
}

const save = () => {
  axios.post('/api/joboffer/update', form.value).then(()=>{
    alert('Vacature gewijzigd!')
  }).catch(()=>{
    alert('Daar ging iets fout..')
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
        <h1>Wijzig hier uw vacature</h1>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="title">Titel</label>
              <input class="form-control" id="title" type="text" v-model="form.title">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="date">Datum</label>
              <input class="form-control" id="date" type="date" v-model="form.date">
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
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="description">Beschrijving</label>
              <textarea id="description" class="form-control" v-model="form.description"/>
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