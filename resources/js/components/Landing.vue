<template>
    <v-app>
        <section id="Hero">
            <v-container class="hero-container" fluid pa-0>
                <v-row class="hero-height" justify="center" align="center">
                    <v-col cols="12" md="6">
                        <v-row justify="center">
                            <span class="display-4 font-weight-black">CARITA:</span>
                        </v-row>
                        <v-row justify="center">
                            <span class="display-3">Tap To Donate</span>
                        </v-row>
                    </v-col>
                    <v-col cols="12" md="6"/>
                </v-row>
            </v-container>
        </section>
        <section id="timeline">
            <v-container class="hero-container" fluid pa-0>
                <v-row justify=center>
                        <h1>Features</h1>
                </v-row>
                <v-row justify=center>
                    <v-col cols="12" md=4>
                            <v-img src="img/Exibit.png"></v-img>
                    </v-col>
                </v-row>
                <v-row justify=center class="mt-n12 pt-n12">
                    <v-col cols="12" md=10>
                            <v-timeline align-top :dense="$vuetify.breakpoint.smAndDown">
                                <v-timeline-item  color="primary" icon="fa-calendar-alt" fill-dot large>
                                    <v-card color="primary" dark>
                                        <v-card-title class="headline">Schedule</v-card-title>
                                        <v-card-text class="white subtitle-1 text--primary">
                                        <p>Be informed about your area's garbage collection dates and time</p>
                                        </v-card-text>
                                    </v-card>
                                </v-timeline-item>
                                <v-timeline-item  color="primary" icon="fa-map-marked-alt" fill-dot large>
                                    <v-card color="primary" dark>
                                        <v-card-title class="headline">Map Routing</v-card-title>
                                        <v-card-text class="white subtitle-1 text--primary">
                                        <p>Check the real-time location of your area's garbage collector when routing.</p>
                                        </v-card-text>
                                    </v-card>
                                </v-timeline-item>
                                <v-timeline-item  color="primary" icon="fa-file-image" fill-dot large>
                                    <v-card color="primary" dark>
                                        <v-card-title class="headline">Report</v-card-title>
                                        <v-card-text class="white subtitle-1 text--primary">
                                        <p>Tell us about alarming piles of garbages that causes harm to the community.</p>
                                        </v-card-text>
                                    </v-card>
                                </v-timeline-item>
                                <v-timeline-item  color="primary" icon="fa-bell" fill-dot large>
                                    <v-card color="primary" dark>
                                        <v-card-title class="headline">Notification</v-card-title>
                                        <v-card-text class="white subtitle-1 text--primary">
                                        <p>Receive notifications about the garbage collection and be informed.</p>
                                        </v-card-text>
                                    </v-card>
                                </v-timeline-item>
                            </v-timeline>
                    </v-col>
                </v-row>
            </v-container>
        </section>
        <footer id="footer" height="350px" padless absolute>
            <v-row justify=center class="white--text hidden-sm-and-down" no-gutters>
                <v-col cols="12" md="4" class="pa-5">
                        <v-row class="" justify="start" align=center>
                            <v-col>
                                <p><v-icon color="white">fa-map-marker</v-icon>  Zamboanga City, Philippines</p>
                            </v-col>
                        </v-row>
                        <v-row class="" justify="start" align=center>
                            <v-col>
                                <p><v-icon color="white">fa-phone</v-icon>  +639954332495</p>
                            </v-col>
                        </v-row>
                        <v-row class="" justify="start" align=center>
                            <v-col>
                                <p><v-icon color="white">fa-envelope</v-icon>  contact@dreamersinfo.com</p>
                            </v-col>
                        </v-row>
                </v-col>
                <v-col cols="12" md="4" class="pa-5">
                        <v-row>
                            <p class="title">
                                About the Company
                            </p>
                        </v-row>
                        <v-row>
                            A startup company based in Zamboanga City. We specialize in developing websites, mobile applications, and desktop applications. We also offer services in computer servicing system, animation, and graphics design.
                        </v-row>
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
                    <span class="white--text">&copy; Copyright Limpieza 2020</span><br>
                </v-col>
                <v-col cols="12" class="white--text text-center">
                    <p>Made With <v-icon id="heart" class="red--text" small>fa-heart</v-icon> by <a class="white--text" href="https://www.dreamersinfo.com" target="_blank">Dreame.rs</a></p>
                </v-col>
            </v-row>
        </footer>
    </v-app>
</template>
<script>
    export default {
        data(){
            return {
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

