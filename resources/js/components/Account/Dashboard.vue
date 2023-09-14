<template>
  <div>
      Dashboard <br>
      <div v-if="user">
      Name: {{user.name}} <br>
      Email: {{user.email}}<br><br>
      <button @click.prevent="logout">Logout</button>
      </div>

  </div>
</template>
<script>
export default {
  data(){
      return{
          user: null
      }
  },
  methods:{
      logout(){
          axios.post('/api/logout').then(()=>{
              this.$router.push({ name: "Home"})
          })
      }
  },
  mounted(){
      axios.get('/api/user').then((res)=>{
          this.user = res.data
          console.log(this.user);
      })
  }
}
</script>
<!-- <template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">You are logged in as <b>{{user.email}}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"dashboard",
    data(){
        return {
            user:this.$store.state.auth.user
        }
    }
}
</script> -->