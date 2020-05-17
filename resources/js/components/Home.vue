<template>
    <v-app id="app">
        <v-navigation-drawer id="drawer" width="250" clipped fixed v-model="drawer" app floating>
            <v-list shaped>
                <v-list-item-group color="primary">
                    <v-list-item ripple="ripple" exact to="/philanthropists">
                        <v-list-item-action>
                            <v-icon>fa-users</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="subheading font-weight-regular">Philanthropists</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item ripple="ripple" exact to="/charities">
                        <v-list-item-action>
                            <v-icon>fa-heart</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="subheading font-weight-regular">Charities</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item ripple="ripple" exact to="/companies">
                        <v-list-item-action>
                            <v-icon>fa-building</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="subheading font-weight-regular">Companies</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item ripple="ripple" exact to="/advertisements">
                        <v-list-item-action>
                            <v-icon>fa-play</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="subheading font-weight-regular">Advertisements</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <!-- <v-list-item ripple="ripple" exact to="/keys">
                        <v-list-item-action>
                            <v-icon>fa-play</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="subheading font-weight-regular">Watch Record</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item> -->
                    <v-list-item  ripple="ripple" @click="logout()">
                        <v-list-item-action >
                            <v-icon>fa-sign-out-alt</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="subheading font-weight-regular">Logout</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>    
        <v-app-bar app fixed clipped-left color="secondary" class="elevation-0">
            <v-app-bar-nav-icon class="hidden-lg-and-up" @click.stop="drawer = !drawer"><v-icon>fas fa-bars</v-icon></v-app-bar-nav-icon>
            <v-toolbar-title>Carita: Tap To Donate</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-app-bar>
        <v-content>
            <v-container fluid>
            <v-row align="center" justify="center" >
                <v-col cols="12" lg=11 md=11 xl=10>
                    <router-view name="home"></router-view>
                </v-col>
            </v-row>
            </v-container>
        </v-content>
        <v-footer app fixed>
            <span>&copy; Carita: Tap To Donate</span>
        </v-footer>
    </v-app>
</template>

<script>
    export default {
        data(){
            return {
                drawer: true,
                type: (localStorage.getItem('user-type')),
            }
        },
        computed: {
        },
        mounted(){
        },
        methods:{
            logout() {
                axios.get('/api/logout')
                .then( response => {
                    if (response.data.errors) {
                        this.error = response.data.errors
                        return
                    }
                    localStorage.clear()
                    this.$router.push('/')
                })
                .catch( error => {   
                    if (error.response.data.message == 'Unauthenticated.') {
                        localStorage.clear()
                        this.$router.push('/')
                    } 
                })
            },
        },
        created() {
        },
        beforeRouteEnter (to, from, next) {
            if(!localStorage.getItem('user-type')){
                return next('/sign-in')
            }
            next();
        }
    }
</script>