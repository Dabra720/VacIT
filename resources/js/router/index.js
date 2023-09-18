import { createRouter, createWebHistory } from 'vue-router';

import notFound from '../components/NotFound.vue';

import jobOfferIndex from '../components/JobOffers/index.vue';
import jobOfferNew from '../components/JobOffers/new.vue';
import jobOfferDetails from '../components/JobOffers/details.vue';

import Login from '../components/Account/Login.vue';
import Register from '../components/Account/Register.vue';
import Dashboard from '../components/Account/Dashboard.vue';
import Profile from '../components/Account/Profile.vue';

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
        component: Profile,
        beforeEnter: (to, form, next) =>{
        axios.get('/api/authenticated').then(()=>{
            next()
        }).catch(()=>{
            return next({ name: 'Login'})
        })
    }
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