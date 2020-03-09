<template>
    <v-card>
      <!-- Header -->
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
                // name: '',
                // user_type: '',
                // tab: null,
                // Sales_Representative: {
                // match_earnings: '0.00',
                // referal_earnings: '0.00',
                // total_earnings: '0.00',
                // total_encashed: '0.00',
                // current_balance: '0.00',
                // securepay_earnings: '0.00',
                // },
                // waiting_members: [],
                // Admin: {

                // },
            }
        },
        methods:{
            // SR_dashboard(){
            //     var id = ''
            //     if(this.user_type == 'Administrator'){
            //     id = 'SLIC-00000001'
            //     }
            //     else{
            //     id = sessionStorage.getItem('user-code')
            //     }
            //     axios.get('api/user-information/'+id+'/dashboard')
            //     .then( response => {
            //         this.Sales_Representative.total_earnings = response.data.success.total_earnings
            //         this.Sales_Representative.current_balance = response.data.success.current_balance
            //         this.Sales_Representative.total_encashed = response.data.success.total_encashed
            //         this.Sales_Representative.match_earnings = response.data.success.total_package_bonus
            //         this.Sales_Representative.referal_earnings = response.data.success.total_direct_incentive
            //         this.Sales_Representative.securepay_earnings = response.data.success.total_rebates
            //         this.waiting_members = response.data.success.waiting_members
            //     })
            //     .catch( error => {})
            // },
        },
        created() {
            // this.user_type = sessionStorage.getItem('user-type')
            // if(this.user_type == 'Administrator'){

            // }
            // else if(this.user_type == 'Associate'){
            //     this.SR_dashboard()
            // }
            // else if(this.user_type == 'Retailer' || this.user_type == 'SecurePay'){

            // }
        },
        beforeRouteEnter (to, from, next) {
            // if(sessionStorage.getItem('user-type') == "Branch"){
            //   return next('/Sales')
            // }
            if(sessionStorage.getItem('user-type') == "Partnered Establishment"){
            return next('/establishment')
            }
            else if(sessionStorage.getItem('user-type') == "Cashier"){
            return next('/cashier')
            }
            next();
        }
    }
</script>
