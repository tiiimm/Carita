<template>
    <v-app id="app">
        <v-navigation-drawer id="drawer" width="250" clipped fixed v-model="drawer" app floating>
            <v-list rounded>
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
                    <v-list-item ripple="ripple" exact to="/keys">
                        <v-list-item-action>
                            <v-icon>fa-play</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="subheading font-weight-regular">Watch Record</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
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
        <v-app-bar app fixed clipped-left class="elevation-0">
            <v-app-bar-nav-icon class="hidden-lg-and-up" @click.stop="drawer = !drawer"><v-icon>fas fa-bars</v-icon></v-app-bar-nav-icon>
            <v-toolbar-title class="hidden-md-and-down">Carita: Tap To Donate</v-toolbar-title>
            <!-- <v-spacer></v-spacer>
            <v-toolbar-title id="home-name" class="primary-text align-start">
                <div class="d-flex align-start">
                <v-icon small>fa-crown</v-icon>{{name}}<v-icon small>fa-crown</v-icon>
                </div>
            </v-toolbar-title> -->
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
                type: (sessionStorage.getItem('user-type')),
                // name: '',
                // code: (sessionStorage.getItem('user-code')),
                // photo: '',
                // PicDialog: false,
                // admin: false,
                // allNotifications: [],
                // notifcount: 0,
            }
        },
        computed: {
            // unreadnotification: function() {
            //     var count = 0;
            //     this.allNotifications.filter(function(notification) {
            //         if(notification.read_at == null){
            //             count++;
            //         }
            //     })
            //     return count;
            // },
            // limitedNotifications: function() {
            //     var allnotif = [];
            //     this.allNotifications.forEach(notification => {
            //     if(this.allNotifications.indexOf(notification) <= 10){
            //         allnotif.push(notification)
            //     }
            //     });
            //     return allnotif;
            // },
            // crownsize () {
            //     switch (this.$vuetify.breakpoint.name) {
            //     case 'xs': return '1em'
            //     case 'sm': return '1.5em'
            //     case 'md': return '1.5em'
            //     case 'lg': return '1.5em'
            //     case 'xl': return '1.5em'
            //     }
            // },
        },
        mounted(){
            // axios.get('api/user-information/notifications')
            // .then( response => {
            //     this.allNotifications = response.data.success.notifications
            //     axios.get('api/user/'+sessionStorage.getItem('user-code'))
            //     .then( response => {
            //         this.name = response.data.success.name
            //         this.photo = response.data.success.photo
            //         })
            //     .catch( error => {})
            // })
            // .catch( error => {})
        },
        methods:{
            logout() {
                sessionStorage.clear()
                this.$router.push('/')
            },
            // markAsRead(){
            //     axios.post('api/user-information/notifications/read')
            //     .then( response => {
            //         this.allNotifications = response.data.success.notifications
            //     })
            //     .catch( error => {})
            //     .finally( x => {
            //     })
            // },
        },
        created() {
            // if(this.type == 'Administrator' || this.type == 'Root'){
            //     this.admin = true
            // }
            // else{
            //     this.admin = false
            // }
        },
        // beforeRouteEnter (to, from, next) {
        //     if (!sessionStorage.getItem('user-code')) {
        //         return next('sign-in');
        //     }
        //     next();
        // }
    }
</script>