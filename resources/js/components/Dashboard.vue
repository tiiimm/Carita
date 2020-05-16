<template>
    <v-card>
        <v-card-title>
          <v-icon color="primary" medium>fa-tachometer-alt</v-icon>
          Dashboard
          <v-spacer></v-spacer>
        </v-card-title>
    </v-card>
</template>
<script>
    export default {
        data(){
            return {
            }
        },
        methods:{
        },
        created() {
        },
        beforeRouteEnter (to, from, next) {
            // if(localStorage.getItem('user-type') == "Partnered Establishment"){
            // return next('/establishment')
            // }
            // else if(localStorage.getItem('user-type') == "Cashier"){
            // return next('/cashier')
            // }
            next();
        }
    }
</script>
