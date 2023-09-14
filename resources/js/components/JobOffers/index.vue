<script setup>
import { onMounted, ref } from 'vue'

let user = ref(null)
let joboffers = ref([])

onMounted(async () => {
    await getUser().then(() =>{
        if(user.value.role == 2){
            console.log('EMPLOYER DETECTED!', user.value.role)
            getCompanyJoboffers()
        }else{
            console.log('NO EMPLOYER HERE!', user)
            getJoboffers()
        }
    }).catch(() => {
        console.log('NO EMPLOYER HERE Either!', user)
        getJoboffers()
    }
    )
    // if(getUser()){
    //     if(user.value.role == 2){
    //         console.log('EMPLOYER DETECTED!', user)
    //         getCompanyJoboffers()
    //     }else{
    //         console.log('NO EMPLOYER HERE!', user)
    //         getJoboffers()
    //     }
    // }else{
    //     getJoboffers()
    // }
    
})

const getJoboffers = async () => {
    let response = await axios.get("/api/joboffers")
    // console.log('response', response)
    joboffers.value = response.data.joboffers
}

const getCompanyJoboffers = async () => {
    let response = await axios.get("/api/get_joboffers?id="+user.value.company_id)
    joboffers.value = response.data.joboffers
}

const getUser = async () => {
    let response = await axios.get("/api/user")
    user.value = response.data
    return user.value
}


</script>
<template>
    <div class="container">
        <div class="row">
            <h1>vacatures index</h1>
            <router-link to="/joboffer/new">Nieuwe vacature</router-link>
        </div>
        <div class="row" v-for="joboffer in joboffers">
            <div class="row">
                <div class="col">
                    <p>{{ joboffer.company_id }}</p>
                </div>
                <div class="col">
                    <p>{{joboffer.title}}</p>
                </div>
                <div class="col">
                    <p>{{joboffer.company.city}}</p>
                </div>
                <div class="col">
                    <p>{{joboffer.date}}</p>
                </div>
            </div>
            <div class="row">
                <p>{{joboffer.description}}</p>
            </div>
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