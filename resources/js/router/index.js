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
const Unauthorized = () => import('../components/Errors/Unauthorized.vue')

/* Authenticated */
const Dashboard = () => import('../components/Account/Dashboard.vue')
const UpdateProfile = () => import('../components/Profile/Update.vue')
const MyApplications = () => import('../components/Account/MyApplications.vue')
const UserProfile = () => import('../components/Profile/Show.vue')
const NewJoboffer = () => import('../components/JobOffers/New.vue')
const UpdateJoboffer = () => import('../components/JobOffers/Update.vue')
const UpdateCompany = () => import('../components/Profile/UpdateCompany.vue')
const NewTimeslots = () => import('../components/Appointments/Create.vue')
const SelectTimeslot = () => import('../components/Appointments/Select.vue')
const Appointments = () => import('../components/Appointments/Index.vue')
const UpdateTimeslots = () => import('../components/Appointments/Update.vue')


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
          title:`Home`,
        },
      },
      {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta:{
          middleware:"auth",
          title:`Profiel`,
        },
      },
      {
        path: '/updateprofile',
        name: 'UpdateProfile',
        component: UpdateProfile,
        meta:{
          middleware:"auth",
          title:`Profiel`,
        },
      },
      {
        path: '/update/company',
        name: 'UpdateCompany',
        component: UpdateCompany,
        meta:{
          middleware:"auth",
          title:`Profiel`,
        },
      },
      {
        path: '/applications',
        name: 'Applications',
        component: MyApplications,
        meta:{
          middleware:"auth",
          title:`Mijn vacatures`,
        },
      },
      {
        path: '/joboffer/show/:id',
        name: 'JobofferShow',
        component: JobofferDetails,
        props: true,
        meta:{
          middleware:"auth",
          title:`Details`,
        },
      },
      {
        path: '/joboffer/new',
        name: 'NewJoboffer',
        component: NewJoboffer,
        meta: {
          middleware: "auth",
          title: "Nieuwe vacature",
          askpermission: true,
        },
      },
      {
        path: '/joboffer/update/:id',
        name: 'UpdateJoboffer',
        component: UpdateJoboffer,
        props: true,
        meta: {
          middleware: "auth",
          title: "Wijzig vacature",
        },
      },
      {
        path: '/profile/:id',
        name: 'Userprofile',
        component: UserProfile,
        props: true,
        meta: {
          middleware: 'auth',
          title: 'Profiel',
        },
      },
      {
        path: '/timeslots/create',
        name: 'NewTimeslots',
        component: NewTimeslots,
        meta: {
          middleware: 'auth',
          title: 'Nieuwe tijdslots',
          askpermission: true,
        },
      },
      {
        path: '/timeslots/update',
        name: 'UpdateTimeslots',
        component: UpdateTimeslots,
        props: true,
        meta: {
          middleware: 'auth',
          title: 'Wijzig tijdslots',
          askpermission: true,
        },
      },
      {
        path: '/timeslots/select/:id/:offer',
        name: 'SelectTimeslot',
        component: SelectTimeslot,
        props: true,
        meta: {
          middleware: 'auth',
          title: 'Maak afspraak',
        },
      },
      {
        path: '/appointments/show',
        name: 'Appointments',
        component: Appointments,
        meta: {
          middleware: 'auth',
          title: 'Mijn afspraken',
        },
      },
      {
        path: '/Unauthorized',
        name: 'Unauthorized',
        component: Unauthorized,
        meta:{
          middleware:"auth",
          title:`Unauthorized`,
        },
      },
      {
        path: '/NotFound',
        name: 'NotFound',
        component: NotFound,
        meta:{
          middleware:"auth",
          title:`Niet gevonden`,
        },
      },
    ],
  },
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
      if(to.meta.askpermission){
        if([1,2].includes(store.state.auth.user.role_id)){ // Employer of Admin
          next()
        }else{
          next({name:"Unauthorized"})
        }
      }else{
        next()
      }
      // console.log("User is authenticated")
      
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