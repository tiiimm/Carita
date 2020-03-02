<template>
    <div>
        <section id="signin">
            <div class="signin-container">
                <header id="header">
                    <div class="container">
                        <div id="logo" class="pull-left">
                            <!-- <a href="/"><img src="https://res.cloudinary.com/tim0923/image/upload/v1580047963/SecureLife/Logo.png" alt="" title="" /></a> -->
                        </div>
                    </div>
                </header>
                <v-row class="signinheight" align=center justify=center>
                    <v-col cols=12 lg=3 justify=center>
                        <v-card max-width="400px" :class="{'my-5 pa-5 elevation-0': $vuetify.breakpoint.mdAndUp}">
                            <!-- <v-layout column class="text-center align-center">
                                <v-img src="img/Logo.png"></v-img>
                            </v-layout> -->
                            <v-card-text>
                                    <!-- Username -->
                                    <v-flex xs12 md12>
                                        <v-text-field light color="primary" outlined label="Username" v-model="email" required prepend-inner-icon="fa-user-circle" autofocus/>
                                    </v-flex>
                                    <!-- Password -->
                                    <v-flex xs12 md12>
                                        <v-text-field light color="primary" outlined :type="show1 ? 'text' : 'password'" @click:append="show1 = !show1" :append-icon="show1 ? 'fa-eye' : 'fa-eye-slash'" label="Password" v-model="password"  required prepend-inner-icon="fa-lock"/>
                                    </v-flex>

                                    <v-row justify="center">
                                        <v-col xs="12" md="12" justify="center">
                                            <v-btn pa-1 block x-large rounded color="primary" class="white--text" @click="login">SIGN-IN</v-btn>
                                        </v-col>
                                    </v-row>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </div>
        </section>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                email : "",
                password : "",
                show1: false,
                loading: false,
            }
        },
        methods: {
            login() {
                this.loading = true
                this.$Progress.start();
                axios.post('api/login', {
                    username: this.email, password: this.password
                })
                .then( response => {
                    // Create a local storage item
                    sessionStorage.setItem('user-token', response.data.success.token)
                    sessionStorage.setItem('user-code', response.data.success.information.code)
                    sessionStorage.setItem('user-type', response.data.success.information.type)
                    swal.fire({
                        position: 'top-end',
                        toast: true,
                        type: 'success',
                        title: 'Successfully Logined',
                        showConfirmButton: false,
                        timer: 1500,
                        onClose: () => {
                            // Redirect user
                            this.$Progress.finish();
                            this.loading = false
                            if(sessionStorage.getItem('user-type') == 'Administrator' || sessionStorage.getItem('user-type') == 'Root'){
                                this.$router.push('genealogy')
                            }
                            else if(sessionStorage.getItem('user-type') == 'Branch'){
                                this.$router.push('inventory')
                            }
                            else{
                                this.$router.push('dashboard')
                            }
                        }

                    })
                })
                .catch( error => {
                    this.$Progress.fail();
                    swal.fire("Failed!",
                    "Incorrect Username/Password",
                    "error")
                })
            }
        },
        created(){

        },
        beforeRouteEnter (to, from, next) {
            if (sessionStorage.getItem('user-code')) {
                
                return next('dashboard');
            }
            else{
                next();
            }
        }
    }
</script>
