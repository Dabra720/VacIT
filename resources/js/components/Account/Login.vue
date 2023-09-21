<script setup>
import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()

let user = inject('user')

let form = ref({
    email: '',
    password: ''
})

let errors = ref([])

const loginUser = async () => {
    await axios.get('/sanctum/csrf-cookie')
    await axios.post('/api/login', form.value).then((res) =>{
        console.log('logged in', res);
        user.value = res.data
        router.push({ name: "Dashboard"}); 
    }).catch((error) =>{
        errors.value = error.response.data.errors;
    })
}

</script>

<template>
<div class="container">
    <div class="row">
    <div class=""><h1>Login to your account</h1></div>
        <form>
            <div class="form-group">
                <label for="email" class="mt-2">Your e-mail</label>
                <input class="form-control" id="email" placeholder="Email" type="email" v-model="form.email">
                <div class="text-danger" v-if="errors.email">{{ errors.email[0] }}</div>
            </div>
            <div class="form-group">
                <label for="password" class="mt-2">Password</label>
                <input class="form-control" id="password" placeholder="Password" type="password" v-model="form.password" name="password">
                <div class="text-danger" v-if="errors.password">{{ errors.password[0] }}</div>
            </div>
            <div class="">
                <button @click.prevent="loginUser" type="submit" class="btn btn-primary my-2">Login</button>
            </div>

        </form>
    </div> 
</div>
</template>

 <!-- <script>
// export default {
//  data(){
//      return{
//          form:{
//              email: '',
//              password: ''
//          },
//          errors: []
//      }
//  },
//  methods:{
//       async loginUser(){
//           await axios.get('/sanctum/csrf-cookie')
//           await axios.post('/api/login', this.form).then((res) =>{
//               console.log('logged in');
//               this.$router.push({ name: "Dashboard"}); 
//           }).catch((error) =>{
//             this.errors = error.response.data.errors;
//          })
//       }
//  }
// }
// </script>
// <template>
//     <div class="container h-100">
//         <div class="row h-100 align-items-center">
//             <div class="col-12 col-md-6 offset-md-3">
//                 <div class="card shadow sm">
//                     <div class="card-body">
//                         <h1 class="text-center">Login</h1>
//                         <hr/>
//                         <form action="javascript:void(0)" class="row" method="post">
//                             <div class="col-12" v-if="Object.keys(validationErrors).length > 0">
//                                 <div class="alert alert-danger">
//                                     <ul class="mb-0">
//                                         <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
//                                     </ul>
//                                 </div>
//                             </div>
//                             <div class="form-group col-12">
//                                 <label for="email" class="font-weight-bold">Email</label>
//                                 <input type="text" v-model="auth.email" name="email" id="email" class="form-control">
//                             </div>
//                             <div class="form-group col-12 my-2">
//                                 <label for="password" class="font-weight-bold">Password</label>
//                                 <input type="password" v-model="auth.password" name="password" id="password" class="form-control">
//                             </div>
//                             <div class="col-12 mb-2">
//                                 <button type="submit" :disabled="processing" @click="login" class="btn btn-primary btn-block">
//                                     {{ processing ? "Please wait" : "Login" }}
//                                 </button>
//                             </div>
//                             <div class="col-12 text-center">
//                                 <label>Don't have an account? <router-link :to="{name:'register'}">Register Now!</router-link></label>
//                             </div>
//                         </form>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     </div>
// </template> -->
<!-- // <script> 
// import { mapActions } from 'vuex'
// export default {
//     name:"login",
//     data(){
//         return {
//             auth:{
//                 email:"",
//                 password:""
//             },
//             validationErrors:{},
//             processing:false
//         }
//     },
//     methods:{
//         ...mapActions({
//             signIn:'auth/login'
//         }),
//         async login(){
//             this.processing = true
//             await axios.get('/sanctum/csrf-cookie')
//             await axios.post('/api/login',this.auth).then(({data})=>{
//                 this.signIn()
//             }).catch(({response})=>{
//                 if(response.status===422){
//                     this.validationErrors = response.data.errors
//                 }else{
//                     this.validationErrors = {}
//                     alert(response.data.message)
//                 }
//             }).finally(()=>{
//                 this.processing = false
//             })
//         },
//     }
// }
// </script>-->