import { createRouter, createWebHistory } from 'vue-router';

import notFound from '../components/NotFound.vue';

import jobOfferIndex from '../components/JobOffers/index.vue';
import jobOfferNew from '../components/JobOffers/New.vue';
import jobOfferDetails from '../components/JobOffers/Details.vue';

import Login from '../components/Account/Login.vue';
import Register from '../components/Account/Register.vue';
import Dashboard from '../components/Account/Dashboard.vue';
import UpdateProfile from '../components/Profile/Update.vue';
import MyApplications from '../components/Account/MyApplications.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: jobOfferIndex,
  },
  {
    path: '/jobOffer/new',
    name: 'newJobOffer',
    component: jobOfferNew,
  },
  {
    path: '/jobOffer/details/:id',
    name: 'jobOfferDetails',
    component: jobOfferDetails,
    props: true
  },
  {
      path: '/register',
      component: Register,
      name: 'Register'
  },
  {
      path: '/login',
      component: Login,
      name: 'Login'
  },
  {
      path: "/dashboard",
      name: "Dashboard",
      component: Dashboard,
      beforeEnter: (to, form, next) =>{
      axios.get('/api/authenticated').then(()=>{
          next()
      }).catch(()=>{
          return next({ name: 'Login'})
      })
    }
  },
  {
    path: "/updateprofile",
    name: "UpdateProfile",
    component: UpdateProfile,
    beforeEnter: (to, form, next) =>{
    axios.get('/api/authenticated').then(()=>{
        next()
    }).catch(()=>{
        return next({ name: 'Login'})
    })
  }
},
  {
    path: '/applications',
    name: 'Applications',
    component: MyApplications,
  },
  {
    path: '/:pathMatch(.*)*',
    component: notFound
  }
]
const router = createRouter({
  history: createWebHistory(),
  routes
})
export default router;