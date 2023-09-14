import { createRouter, createWebHistory } from 'vue-router';

import notFound from '../components/NotFound.vue';
import jobOfferIndex from '../components/JobOffers/index.vue';
import jobOfferNew from '../components/JobOffers/new.vue';
import Login from '../components/Account/Login.vue';
import Register from '../components/Account/Register.vue';
import Dashboard from '../components/Account/Dashboard.vue';

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
    path: '/:pathMatch(.*)*',
    component: notFound
  }
]
const router = createRouter({
  history: createWebHistory(),
  routes
})
export default router;