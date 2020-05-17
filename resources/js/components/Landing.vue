<template>
    <v-app>
        <section>
            <v-container id="Hero" class="hero-container hidden-md-and-down" fluid pa-0>
                <v-row class="hero-height" justify="center" align="center">
                    <v-col cols="12" md="6">
                        <v-row justify="center">
                            <span class="display-4 font-weight-black">CARITA:</span>
                        </v-row>
                        <v-row justify="center">
                            <span class="display-3">Tap To Donate</span>
                        </v-row>
                        <br>
                        <v-row justify="center">
                            <v-btn depressed color="primary" href="../img/carita.apk" download>Download APK</v-btn>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="6"/>
                </v-row>
            </v-container>
            <v-row class="hero-height hidden-md-and-up" justify="center" align="center" style="background: url(../img/md.png) top center; background-size: cover;">
                <v-col cols="12" md="6">
                    <v-row justify="center">
                        <v-img aspect-ratio="2" contain src="img/phones.png"></v-img>
                    </v-row>
                    <v-row justify="center">
                        <span class="display-3 font-weight-black">CARITA:</span>
                    </v-row>
                    <v-row justify="center">
                        <span class="display-2">Tap To Donate</span>
                    </v-row>
                    <v-row justify="center">
                        <v-btn depressed color="primary" href="../img/carita.apk" download>Download APK</v-btn>
                    </v-row>
                </v-col>
            </v-row>
        </section>
        <section id="timeline" class="hidden-md-and-down">
                <v-row justify=center>
                        <p class="display-3 font-weight-black">Features</p>
                </v-row>
                <v-row justify=center>
                    <v-col cols="12" md=4>
                            <v-img src="img/Exibit.png"></v-img>
                    </v-col>
                </v-row>
                <v-row justify=center class="mt-n12 pt-n12">
                    <v-col cols="12" md="4" class="pa-5" justify=center>
                        <v-row class="" justify=center align=center>
                            <v-col justify=center align=center>
                                <v-img width="200" height="200" src="img/image_charities.png"></v-img>
                            </v-col>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p class="display-1" justify=center align=center>Charities</p>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p justify=center align=center>Find your local charities and support them</p>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="4" class="pa-5" justify=center>
                        <v-row class="" justify=center align=center>
                            <v-col justify=center align=center>
                                <v-img width="200" height="200" src="img/image_events.png"></v-img>
                            </v-col>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p class="display-1" justify=center align=center>Events</p>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p justify=center align=center>Be aware of charity events and join of them</p>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="4" class="pa-5" justify=center>
                        <v-row class="" justify=center align=center>
                            <v-col justify=center align=center>
                                <v-img width="200" height="200" src="img/image_advertisements.png"></v-img>
                            </v-col>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p class="display-1" justify=center align=center>Donate</p>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p justify=center align=center>Help raise funds for the less fortunate by watching advertisements</p>
                        </v-row>
                    </v-col>
                </v-row>
        </section>
        <section id="timeline" class="hidden-md-and-up">
                <v-row justify=center>
                        <p class="display-2 font-weight-black">Features</p>
                </v-row>
                <v-row justify=center>
                    <v-col cols="12" sm=4>
                            <v-img src="img/Exibit.png"></v-img>
                    </v-col>
                </v-row>
                <v-row justify=center class="mt-n12 pt-n12">
                    <v-col cols="10" sm="4" class="pa-5" justify=center>
                        <v-row class="" justify=center align=center>
                            <v-col justify=center align=center>
                                <v-img width="100" height="100" src="img/image_charities.png"></v-img>
                            </v-col>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p class="display-1" justify=center align=center>Charities</p>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p justify=center align=center>Find your local charities and support them</p>
                        </v-row>
                    </v-col>
                    <v-col cols="10" sm="4" class="pa-5" justify=center>
                        <v-row class="" justify=center align=center>
                            <v-col justify=center align=center>
                                <v-img width="100" height="100" src="img/image_events.png"></v-img>
                            </v-col>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p class="display-1" justify=center align=center>Events</p>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p justify=center align=center>Be aware of charity events and join of them</p>
                        </v-row>
                    </v-col>
                    <v-col cols="10" sm="4" class="pa-5" justify=center>
                        <v-row class="" justify=center align=center>
                            <v-col justify=center align=center>
                                <v-img width="100" height="100" src="img/image_advertisements.png"></v-img>
                            </v-col>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p class="display-1" justify=center align=center>Donate</p>
                        </v-row>
                        <v-row class="" justify=center align=center>
                            <p justify=center align=center>Help raise funds for the less fortunate by watching advertisements</p>
                        </v-row>
                    </v-col>
                </v-row>
        </section>
        <footer id="footer" height="350px" padless absolute>
            <v-row justify=center align=center class="white--text">
                <v-col cols="12" md="4" class="pa-5">
                        <v-row class="" justify="start" align=center>
                            <v-col>
                                <p><v-icon color="white">fa-map-marker</v-icon>  Zamboanga City, Philippines</p>
                            </v-col>
                        </v-row>
                        <v-row class="" justify="start" align=center>
                            <v-col>
                                <p><v-icon color="white">fa-phone</v-icon>  +639759458361</p>
                            </v-col>
                        </v-row>
                        <v-row class="" justify="start" align=center>
                            <v-col>
                                <p><v-icon color="white">fa-envelope</v-icon>  contact@carita.com</p>
                            </v-col>
                        </v-row>
                </v-col>
                <v-col cols="12" md="4" class="pa-5">
                        <!-- <v-row>
                            <p class="title">
                                About the Company
                            </p>
                        </v-row>
                        <v-row>
                            A startup company based in Zamboanga City. We specialize in developing websites, mobile applications, and desktop applications. We also offer services in computer servicing system, animation, and graphics design.
                        </v-row> -->
                </v-col>
            </v-row>
            <v-row justify=center no-gutters>
                <v-col class="text-center">
                    <v-btn class="mx-2 white--text" icon>
                        <v-icon size="22px">fab fa-facebook</v-icon>
                    </v-btn>
                    <v-btn class="mx-2 white--text" icon>
                        <v-icon size="22px">fab fa-twitter</v-icon>
                    </v-btn>
                    <v-btn class="mx-2 white--text" icon>
                        <v-icon size="22px">fab fa-instagram</v-icon>
                    </v-btn>
                    <v-btn class="mx-2 white--text" icon>
                        <v-icon size="22px">fab fa-youtube</v-icon>
                    </v-btn>
                </v-col>
            </v-row>
            <v-row justify=center no-gutters>
                <v-col cols="12" class="text-center">
                    <span class="white--text">&copy; Copyright Carita 2020</span><br>
                </v-col>
                <!-- <v-col cols="12" class="white--text text-center">
                    <p>Made With <v-icon id="heart" class="red--text" small>fa-heart</v-icon> by <a class="white--text" href="https://www.dreamersinfo.com" target="_blank">Dreame.rs</a></p>
                </v-col> -->
            </v-row>
        </footer>
    </v-app>
</template>
<script>
    export default {
        data(){
            return {
                url: "https://drive.google.com/open?id=1ttI6JSy16P5Q7G76GjTJD9VAK0HitWmC",
                // email : "",
                // genealogyCount: 0,
            }
        },
        computed: {
            btnsize () {
                switch (this.$vuetify.breakpoint.name) {
                case 'xs': return '150px'
                case 'sm': return '150px'
                case 'md': return '200px'
                case 'lg': return '200px'
                case 'xl': return '200px'
                }
            },
        },
        methods : {
            handleSubmit(){
                
            },
            // getCount(){
            //     axios.get('api/genealogy-count')
            //     .then( response => {
            //         this.genealogyCount = response.data
            //     })
            //     .catch( error => {})
            //     .finally( x => {
            //     })
            // },
        },
        created() {
            // this.getCount();
            // const that = this;
            // setInterval(function() {
            //     that.genealogyCount += 1;
            // }, 3000);
        }
    }
</script>

