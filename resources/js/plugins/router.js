import Vue from 'vue'
import VueRouter from 'vue-router'

// Main
import Main from '../components/Main.vue'
import Landing from '../components/Landing.vue'
import Signin from '../components/Sign-in.vue'
import Home from '../components/Home.vue'

import Dashboard from '../components/Dashboard.vue'
import Charities from '../components/Charities.vue'
import Companies from '../components/Companies.vue'
import Philanthropists from '../components/Philanthropists.vue'
import Advertisements from '../components/Advertisements.vue'


Vue.use(VueRouter)

const routes = [
    {
        path: '/', name: 'main', component: Main,
        children: [
            { path: '/', name: 'landing', components: {main: Landing}},
            { path: '/sign-in', name: 'Signin', components: {main: Signin}},
        ]
    },
    {
        path: '/home', name: 'home', component: Home,
        children: [
            // {path: '/dashboard', components: {home: Dashboard}},
            {path: '/philanthropists', components: {home: Philanthropists}},
            {path: '/charities', components: {home: Charities}},
            {path: '/companies', components: {home: Companies}},
            {path: '/advertisements', components: {home: Advertisements}},
        ]
    },
]

const opts = {
    mode: 'history',
    routes
}

export default new VueRouter(opts)
