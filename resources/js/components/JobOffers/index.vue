<script setup>
import { onMounted, ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'

const router = useRouter()
const store = useStore()

// const user = inject('user')
const user = store.state.auth.user

// let user = ref(null)
let joboffers = ref([])

onMounted(async () => {
    if(user != null){
        console.log('user', user)
        if(user.role == 2){
            console.log('EMPLOYER DETECTED!', user.role)
            getCompanyJoboffers()
        }else{
            console.log('NO EMPLOYER HERE!', user)
            getJoboffers()
        }
    }else{
        getJoboffers()
    }
    
})

const getJoboffers = async () => {
    let response = await axios.get("/api/joboffers")
    // console.log('response', response)
    joboffers.value = response.data.joboffers
}

const getCompanyJoboffers = async () => {
    let response = await axios.get("/api/get_joboffers?id="+user.company_id)
    joboffers.value = response.data.joboffers
}

// const getUser = async () => {
//     try {
//         let response = await axios.get("/api/user")
//         user.value = response.data
//         // return user.value
//     } catch (error) {
//         console.log('error', error)
//     }
    
// }

const onShow = (id) => {
    router.push('/joboffer/details/'+id)
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
                
                <div class="card mb-1" v-for="joboffer in joboffers" :key="joboffer.id">
                    <div class="row no-gutters">
                        <div class="col-md-2">
                            <!-- <img src="" class="card-img"/> -->
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{joboffer.date}}</h5>
                                <h3 class="card-title">{{ joboffer.title }} voor {{ joboffer.company.name }}</h3>
                                <p class="card-text">{{ joboffer.description }}</p>
                            </div>
                        </div>
                        <div class="col-2 d-flex align-items-center">
                            <div class="text-center">
                                <router-link to="#" @click="onShow(joboffer.id)" class="btn btn-secondary" >GO</router-link>
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
<script>
// export default {
//   data(){
//       return{
//           joboffers: null
//       }
//   },
//   methods:{
//     //   logout(){
//     //       axios.post('/api/logout').then(()=>{
//     //           this.$router.push({ name: "Home"})
//     //       })
//     //   }
//   },
//   mounted(){
//       axios.get('/api/joboffers').then((res)=>{
//           this.joboffers = res.data.joboffers
//           console.log(this.joboffers);
//       })
//   }
// }
// </script>