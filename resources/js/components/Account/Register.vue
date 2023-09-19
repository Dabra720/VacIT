<template>
  <div class="container">
    <div class="row">
        <div class=""><h1>Register an account</h1></div>
        <div class="form-group">
            <label class="mt-2" for="name">Name</label>
            <span class="" v-if="errors.name">{{errors.name[0]}}</span>
            <input class="form-control" placeholder="Name" type="text" v-model="form.name" >
        </div>
        <div class="form-group">
            <label class="mt-2" for="email">Your e-mail</label>
            <span class="" v-if="errors.email">{{errors.email[0]}}</span>
            <input class="form-control" placeholder="E-mail" type="text" v-model="form.email" >
        </div>
        <div class="form-group">
            <label class="mt-2" for="password">Password</label>
            <input class="form-control" placeholder="Password" type="password" v-model="form.password" name="password">
        </div>
        <div class="form-group">
            <label class="mt-2" for="confirm_password">Confirm Password</label>
            <input class="form-control" placeholder="Confirm Password" type="password" v-model="form.password_confirmation" name="password_confirmation">
        </div>
        <div class="">
            <button @click.prevent="saveForm" type="submit" class="btn btn-primary my-2">Register</button>
        </div>
    </div> 
</div>
</template>
<script>
export default {
data(){
    return{
        form:{
            name: '',
            email: '',
            password:'',
            password_confirmation:''
        },
        errors:[]
    }
},
methods:{
    saveForm(){
        axios.post('/api/register', this.form).then(() =>{
            console.log('saved');
            this.$router.push('/');
        }).catch((error) =>{
            this.errors = error.response.data.errors;
        })
    }
}
}
</script>
<!-- <template>
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Register</h1>
                        <hr/>
                        <form action="javascript:void(0)" @submit="register" class="row" method="post">
                            <div class="col-12" v-if="Object.keys(validationErrors).length > 0">
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="name" class="font-weight-bold">Name</label>
                                <input type="text" name="name" v-model="user.name" id="name" placeholder="Enter name" class="form-control">
                            </div>
                            <div class="form-group col-12 my-2">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="text" name="email" v-model="user.email" id="email" placeholder="Enter Email" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" name="password" v-model="user.password" id="password" placeholder="Enter Password" class="form-control">
                            </div>
                            <div class="form-group col-12 my-2">
                                <label for="password_confirmation" class="font-weight-bold">Confirm Password</label>
                                <input type="password_confirmation" name="password_confirmation" v-model="user.password_confirmation" id="password_confirmation" placeholder="Enter Password" class="form-control">
                            </div>
                            <div class="col-12 mb-2">
                                <button type="submit" :disabled="processing" class="btn btn-primary btn-block">
                                    {{ processing ? "Please wait" : "Register" }}
                                </button>
                            </div>
                            <div class="col-12 text-center">
                                <label>Already have an account? <router-link :to="{name:'login'}">Login Now!</router-link></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'
export default {
    name:'register',
    data(){
        return {
            user:{
                name:"",
                email:"",
                password:"",
                password_confirmation:""
            },
            validationErrors:{},
            processing:false
        }
    },
    methods:{
        ...mapActions({
            signIn:'auth/login'
        }),
        async register(){
            this.processing = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/register',this.user).then(response=>{
                this.validationErrors = {}
                this.signIn()
            }).catch(({response})=>{
                if(response.status===422){
                    this.validationErrors = response.data.errors
                }else{
                    this.validationErrors = {}
                    alert(response.data.message)
                }
            }).finally(()=>{
                this.processing = false
            })
        }
    }
}
</script> -->