import { createRouter, createWebHistory } from 'vue-router';
import store from '../store'

/* Layouts */
const GuestLayout = () => import('../components/Layouts/GuestLayout.vue')
const MainLayout = () => import('../components/Layouts/AuthLayout.vue')

/* Guest */
const Login = () => import('../components/Account/Login.vue')
const Register = () => import('../components/Account/Register.vue')
const Home = () => import('../components/JobOffers/index.vue')
const JobofferDetails = () => import('../components/JobOffers/Details.vue')
const NotFound = () => import('../components/NotFound.vue')

/* Authenticated */
const Dashboard = () => import('../components/Account/Dashboard.vue')
const UpdateProfile = () => import('../components/Profile/Update.vue')
const MyApplications = () => import('../components/Account/MyApplications.vue')


const publicRoutes = [
  {
    path: '/',
    component: GuestLayout,
    children: [
      {
        path: '',
        name: 'Index',
        component: Home,
        meta:{
          middleware:"guest",
          title:`Home`
        }
      },
      {
        path: '/register',
        component: Register,
        name: 'Register',
        meta:{
          middleware:"guest",
          title:`Register`
        }
      },
      {
        path: '/login',
        component: Login,
        name: 'Login',
        meta:{
          middleware:"guest",
          title:`Login`
        }
      },
      {
        path: '/joboffer/details/:id',
        name: 'JobofferDetails',
        component: JobofferDetails,
        props: true,
        meta:{
          middleware:"guest",
          title:`Details`
        }
      },
      {
        path: '/:pathMatch(.*)*',
        component: NotFound,
        meta:{
          middleware:"guest",
          title:`Niet gevonden`
        }
      }
    ]
  },

]

const mainRoutes = [
  {
    path: '/home',
    component: MainLayout,

    children: [
      {
        path: '/home',
        name: 'Home',
        component: Home,
        meta:{
          middleware:"auth",
          title:`Home`
        }
      },
      {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta:{
          middleware:"auth",
          title:`Profiel`
        }
      },
      {
        path: '/updateprofile',
        name: 'UpdateProfile',
        component: UpdateProfile,
        meta:{
          middleware:"auth",
          title:`Profiel`
        }
      },
      {
        path: '/applications',
        name: 'Applications',
        component: MyApplications,
        meta:{
          middleware:"auth",
          title:`Mijn vacatures`
        }
      },
      {
        path: '/joboffer/show/:id',
        name: 'JobofferShow',
        component: JobofferDetails,
        props: true,
        meta:{
          middleware:"auth",
          title:`Details`
        }
      },
      {
        path: '/NotFound',
        name: 'NotFound',
        component: NotFound,
        meta:{
          middleware:"auth",
          title:`Niet gevonden`
        }
      }
    ]
  }
]


const router = createRouter({
  history: createWebHistory(),
  routes: mainRoutes.concat(publicRoutes)
  // routes: publicRoutes
})

router.beforeEach((to, from, next) => {
  // console.log("to", to)
  // console.log("Authenticated: ", store.state.auth.authenticated)
  document.title = `${to.meta.title}`
  if(to.meta.middleware=="auth"){
    if(store.state.auth.authenticated){
      // console.log("User is authenticated")
      next()
    }else{
      // console.log("User is not logged in")
      next({name:"Login"})
    }
  }else if(to.meta.middleware=="guest"){
    if(!store.state.auth.authenticated){
      // console.log("Guest is not logged in")
      next()
    }else{
      console.log('Guest is authenticated')
      switch(to.name){
        case "Index":
          next({name:"Home"})
          break;
        case "JobofferDetails":
          next(`/joboffer/show/${to.params.id}`)
          break;
        default:
          next({name: "NotFound"})
      }
    }
  }else{
    next()
  }
})

export default router;