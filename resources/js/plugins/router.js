import Vue from 'vue'
import VueRouter from 'vue-router'

// Main
import Main from '../components/Main.vue'
import Landing from '../components/Landing.vue'
// import About from '../components/Main/About.vue'
import Signin from '../components/Sign-in.vue'
// import Signup from '../components/Sign-up.vue'
import Home from '../components/Home.vue'

// // Home
// import Profile from '../components/Home/Profile.vue'
import Dashboard from '../components/Dashboard.vue'
import Charities from '../components/Charities.vue'
import Companies from '../components/Companies.vue'
import Philanthropists from '../components/Philanthropists.vue'
// import DashboardAccount from '../components/Home/DashboardAccount.vue'
// import Genealogy from '../components/Home/Genealogy.vue'
// import Notifications from '../components/Home/Notification.vue'
// import Reward from '../components/Home/Reward.vue'
// import Wallet from '../components/Home/Wallet.vue'

// // Admin
// import Keys from '../components/Home/Admin/Keys.vue'
// import Branch from '../components/Home/Admin/Branch.vue'
// import VisitBranch from '../components/Home/Admin/VisitBranch.vue'
// import Inventory from '../components/Home/Admin/Inventory.vue'
// import PartneredEstablishment from '../components/Home/Admin/PartneredEstablishment.vue'
// import Requests from '../components/Home/Admin/Requests.vue'

// // Owner
// import Staff from '../components/Home/Owner/Staff.vue'

// // Cashier
// import Cashier from '../components/Home/Cashier/Cashier.vue'
// import Sales from '../components/Home/Cashier/Sales.vue'
// import POS from '../components/Home/Cashier/POS.vue'

// // Partnered establishment
// import PartneredEstablishmentView from '../components/Home/PartneredEstablishment.vue'

// // Websockets Testing
// import WebsocketTesting from '../components/LandingComponent.vue'


Vue.use(VueRouter)

const routes = [
    // {
    //     path: '/websockets-testing',
    //     name: 'websockets-testing',
    //     component: WebsocketTesting,
    // },
    // {
    //     path: '/establishment',
    //     name: 'establishment',
    //     component: PartneredEstablishmentView,
    // },
    // {
    //     path: '/cashier', name: 'cashier', component: POS,
    //     children: [
    //         { path: '/cashier', name: 'cashier', components: {cashier: Cashier}},
    //         { path: '/cashier-sales', name: 'sales', components: {cashier: Sales}},
    //     ]
    // },
    {
        path: '/', name: 'main', component: Main,
        children: [
            { path: '/', name: 'landing', components: {main: Landing}},
            // { path: '/about', name: 'about', components: {main: About}},
            { path: '/sign-in', name: 'Signin', components: {main: Signin}},
            // { path: '/sign-up', name: 'Signup', components: {main: Signup}},
        ]
    },
    {
        path: '/home', name: 'home', component: Home,
        children: [
            // {path: '/profile', components: {home: Profile}},
            {path: '/dashboard', components: {home: Dashboard}},
            {path: '/philanthropists', components: {home: Philanthropists}},
            {path: '/charities', components: {home: Charities}},
            {path: '/companies', components: {home: Companies}},
            // {path: '/dashboardaccount', components: {home: DashboardAccount}},
            // { path: '/genealogy', components: {home: Genealogy}},
            // { path: '/notifications', components: {home: Notifications}},
            // { path: '/rewards', components: {home: Reward}},
            // { path: '/keys', components: {home: Keys} },
            // { path: '/branches', components: {home: Branch} },
            // { path: '/visit_branch/', name: 'visit_branch', components: {home: VisitBranch} },
            // { path: '/inventory', components: {home: Inventory}},
            // { path: '/staffs', components: {home: Staff}},
            // { path: '/partnered-establishments', components: {home: PartneredEstablishment} },
            // { path: '/wallet', components: {home: Wallet}},
            // { path: '/sales', components: {home: Sales}},
            // { path: '/requests', components: {home: Requests}},
        ]
    },
]

const opts = {
    mode: 'history',
    routes
}

export default new VueRouter(opts)
