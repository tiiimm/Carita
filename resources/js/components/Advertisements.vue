<template>
    <v-layout row>
        <v-flex xs12>
            <v-container class="px-7">
                <v-card>
                    <v-card-title>
                        <v-icon class="mr-2" color="primary">fa-play</v-icon>
                        Advertisements
                        <v-spacer/>
                        <v-text-field class="mr-5" label="Search" v-model="search" prepend-inner-icon="fa-search"/>
                        <!-- <v-btn outlined color="primary" @click.stop='advertisement_dialog = true'>
                            Add Payment
                        </v-btn> -->
                    </v-card-title>
                    <v-data-table :headers="headers" :items="advertisements" :search="search" :loading="loading">
                        <template v-slot:item.id="{ item }">
                            {{ advertisements.map(function(x) {return x.id; }).indexOf(item.id) + 1}}
                        </template>
                        <template v-slot:item.charity.name="{ item }">
                            <span v-if="item.charity != undefined">{{item.charity.name}}</span>
                            <span v-else>None (Open to all)</span>
                        </template>
                        <template v-slot:item.active_until="{ item }">
                            <span v-if="item.active_until != undefined">{{item.active_until}}</span>
                            <span v-else>No Payment History</span>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon medium color="green" @click="approve_advertisement(item)">
                                fa-plus
                            </v-icon>
                            <!-- <v-icon medium color="red" @click="reject_advertisement(item)" v-if="item.status=='Pending'">
                                fa-times
                            </v-icon> -->
                            <!-- <v-icon medium color="blue" @click="open_update_advertisement_dialog(item)">
                                fa-pen
                            </v-icon>
                            <v-icon medium color="red" @click="delete_advertisement(item)">
                                fa-trash
                            </v-icon> -->
                        </template>
                    </v-data-table>
                </v-card>
                <!-- <v-dialog v-model="advertisement_dialog" persistent max-width="700px">
                    <v-card>
                        <v-card-title class="headline" column>
                            <p display-3 v-show="!edit_mode">New Advertisement Information</p>
                            <p display-3 v-show="edit_mode">Update Advertisement Information</p>
                            <v-spacer></v-spacer>
                            <v-btn small fab @click="reset_data">
                            <v-icon>fa-times</v-icon>
                            </v-btn>
                        </v-card-title>
                        <v-card-text column align-center>
                            <v-container grid-list-sm bt-0>
                                <v-layout row wrap>
                                    <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Name" v-model="advertisement_details.name" required prepend-inner-icon="fa-user-circle"/>
                                    </v-flex>
                                    <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Username" v-model="advertisement_details.username" required prepend-inner-icon="fa-at"/>
                                    </v-flex>
                                    <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Email" v-model="advertisement_details.email" required prepend-inner-icon="fa-envelope"/>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn v-show="!edit_mode" color="green darken-1" text @click="add_advertisement">Save</v-btn>
                            <v-btn v-show="edit_mode" color="green darken-1" text @click="update_advertisement" >Update</v-btn>
                            <v-btn type="button" color="red darken-1" text @click="reset_data">Close</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog> -->
                <v-dialog v-model="add_payment_dialog" persistent max-width="700px">
                    <v-card>
                        <v-card-title class="headline" column>
                            <p display-3>New Payment Transaction</p>
                            <v-spacer></v-spacer>
                            <v-btn small fab @click="reset_data">
                            <v-icon>fa-times</v-icon>
                            </v-btn>
                        </v-card-title>
                        <v-card-text column align-center>
                            <v-container grid-list-sm bt-0>
                                <v-layout row wrap>
                                    <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Company" v-model="advertisement_details.name" required/>
                                    </v-flex>
                                    <v-row  xs12 md12 lg12>
                                        <v-col xs6 md6 lg6>
                                             <v-text-field class="purple-input" label="Months" onkeypress="return event.charCode >= 48 && event.charCode <= 57" v-model="months" required/>
                                        </v-col>
                                        <v-col xs6 md6 lg6>
                                             <v-text-field class="purple-input" label="Amount" onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46" v-model="advertisement_details.amount" required/>
                                        </v-col>
                                    </v-row>
                                    <v-row  xs12 md12 lg12>
                                        <v-col xs6 md6 lg6>
                                             <!-- <v-menu v-model="inclusive_from_menu" transition="scale-transition" offset-y max-width="290px" min-width="290px">
                                                  <template v-slot:activator="{ on }"> -->
                                                       <v-text-field v-model="advertisement_details.inclusive_from" label="Inclusive From" persistent-hint readonly/>
                                                  <!-- </template>
                                                  <v-date-picker v-model="advertisement_details.inclusive_from" no-title @input="inclusive_from_menu = false"/>
                                             </v-menu> -->
                                        </v-col>
                                        <v-col xs6 md6 lg6>
                                             <!-- <v-menu v-model="inclusive_to_menu" transition="scale-transition" offset-y max-width="290px" min-width="290px">
                                                  <template v-slot:activator="{ on }"> -->
                                                       <v-text-field v-model="advertisement_details.inclusive_to" label="Inclusive To" persistent-hint readonly/>
                                                  <!-- </template>
                                                  <v-date-picker v-model="advertisement_details.inclusive_to" no-title @input="inclusive_to_menu = false"/>
                                             </v-menu> -->
                                        </v-col>
                                    </v-row>
                                    <v-flex xs12 md12 lg12>
                                        <v-menu v-model="date_menu" transition="scale-transition" offset-y max-width="290px" min-width="290px">
                                             <template v-slot:activator="{ on }">
                                                  <v-text-field v-model="advertisement_details.date_paid" label="Date Paid" persistent-hint readonly v-on="on"/>
                                             </template>
                                             <v-date-picker v-model="advertisement_details.date_paid" :max="now_date" no-title @input="date_menu = false"/>
                                        </v-menu>
                                    </v-flex>
                                    <!-- <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Payment Date" v-model="advertisement_details.date_paid" required/>
                                    </v-flex> -->
                                </v-layout>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="green darken-1" text @click="add_payment">Save</v-btn>
                            <v-btn type="button" color="red darken-1" text @click="reset_data">Close</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-container>
        </v-flex>
    </v-layout>
</template>
<script>
     export default {
          data: () => ({
               //   advertisement_dialog: false,
               add_payment_dialog: false,
               edit_mode: false,
               loading: false,
               search: '',
               date_menu: false,
               inclusive_from_menu: false,
               inclusive_to_menu: false,
               now_date: '',
               months: '1',
               advertisements: [],
               advertisement_details: {
                    id: '',
                    name: '',
                    email: '',
                    username: '',
                    role: 'Advertisement',
                    password: '123456789',
               },
               headers: [
                    {text: '#', value: 'id'},
                    {text: 'Name', value: 'name'},
                    {text: 'Company', value: 'company.name'},
                    {text: 'Partnered Charity', value: 'charity.name'},
                    {text: 'Advertisement Type', value: 'advertisement_type'},
                    {text: 'Billing Date', value: 'billing_date'},
                    {text: 'Active Until', value: 'active_until'},
                    {text: 'Status', value: 'status'},
                    {text: 'Views', value: 'views'},
                    {text: 'Actions', value: 'actions', align: 'right', sortable: false},
               ],
          }),
          watch: {
               months(val) {
                    if (parseInt(val)<1) {
                         this.months = 1
                         this.advertisement_details.inclusive_to= this.$moment(this.advertisement_details.inclusive_from).add(val, 'M').format("YYYY-MM-DD")
                    }
                    else
                         this.advertisement_details.inclusive_to= this.$moment(this.advertisement_details.inclusive_from).add(val, 'M').format("YYYY-MM-DD")
               }
          },
          methods: {
               open_update_advertisement_dialog(item) {
                    this.advertisement_details = {
                         id: item.id,
                         name: item.name,
                         email: item.email,
                         username: item.username,
                         role: 'Advertisement',
                         password: '123456789'
                    }
                    this.advertisement_dialog = true
                    this.edit_mode = true
               },
               reset_data() {
                    this.add_payment_dialog = false
                    this.edit_mode = false
                    this.advertisement_details= {
                         id: '',
                         name: '',
                         email: '',
                         username: '',
                         role: 'Advertisement',
                         password: '123456789'
                    }
                    this.months = 1
               },
               approve_advertisement(item) {
                    var bill = item.billing_date
                    if (item.active_until != undefined)
                         bill = item.active_until
                    this.months = 1
                    this.advertisement_details = {
                         id: item.id,
                         name: item.company.name,
                         inclusive_from: bill,
                         inclusive_to: this.$moment(bill).add(1, 'M').format("YYYY-MM-DD"),
                    }
                    this.now_date = new Date().toISOString().substr(0, 10);
                    this.add_payment_dialog = true;
               },
               reject_advertisement(item) {
                    axios.put('/api/reject-advertisement/' + item.id).then(response => {
                         swal.fire(
                         'Success!',
                         'Successfully rejected advertisement',
                         'success'
                         )
                         this.get_advertisements()
                         this.reset_data()
                    })
               },
               add_payment() {
                    axios.post('/api/payment',{
                         company_advertisement_id: this.advertisement_details.id,
                         inclusive_from: this.advertisement_details.inclusive_from,
                         inclusive_to: this.advertisement_details.inclusive_to,
                         date_paid: this.advertisement_details.date_paid,
                         amount: this.advertisement_details.amount,
                    }).then(response => {
                         swal.fire(
                         'Success!',
                         'Successfully added advertisement',
                         'success'
                         )
                         this.get_advertisements()
                         this.reset_data()
                    })
               },
               update_advertisement() {
                    axios.put('/api/update_advertisement',{
                         advertisement_details: this.advertisement_details
                    }).then(response => {
                         if (response.data.success) {
                         this.get_advertisements()
                         this.reset_data()
                         }
                    })
               },
               delete_advertisement(item) {
               axios.delete('/api/delete_advertisement',{
                    params: {
                    id: item.id
                    }
                    }).then(() => {
                         this.get_advertisements()
                         this.reset_data()
                         })
                    },
                    get_advertisements() {
                         axios.get('/api/advertisements').then(response => {
                         this.advertisements = response.data
                    })
               }
          },
          created() {
               this.get_advertisements()
          },
          beforeRouteEnter (to, from, next) {
               // if(localStorage.getItem('user-type') != 'Branch'){
               //     return next('dashboard')
               // }
               next();
          }
     }
</script>