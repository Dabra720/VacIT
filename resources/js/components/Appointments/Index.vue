<script setup>
import { onMounted, ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'

const router = useRouter()
const store = useStore()

const user = store.state.auth.user

let appointments = ref([])

onMounted(async () => {
    getAppointments()
})

const getAppointments = async () => {
    axios.get(`/api/appointments/show/${user.company_id}`).then(res=>{
        console.log('Afspraken: ', res.data.appointments)
        appointments.value = res.data.appointments
    }).catch(err=>{
        console.log('error: ', err.response)
    })
}


</script>
<template>
    <div class="container pt-4">
        <div class="row">
            <aside class="col-md-4 d-none d-md-block bg-light sidebar">
                <!-- Image rotation of different logo's -->
            </aside>
            <main class="col-md-8 ms-sm-auto col-lg-8 px-md-4">
                <!-- <router-link to="/joboffer/new" v-if="user && user.value.role != 3">Nieuwe vacature</router-link> -->
                <h1>Mijn afspraken:</h1>
                <div class="card mb-1" v-for="appointment in appointments" :key="appointment.id">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="card-body">
                                <p>Tijd: {{ appointment.date + " / " + appointment.start }}</p>
                                <p>Duur: {{ appointment.duration + " minuten" }}</p>
                                <p>Kandidaat: <a href="#">{{ appointment.user.name }}</a> </p>
                                <p>Betreft: <a href="">{{ appointment.joboffer.title }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <br/>
    <table>
        <th></th>
    </table>
</template>