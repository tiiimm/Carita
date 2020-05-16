<template>
    <v-layout row>
        <v-flex xs12>
            <v-container class="px-7">
                <v-card>
                    <v-card-title>
                        <v-icon class="mr-2" color="primary">fa-users</v-icon>
                        Companies
                        <v-spacer/>
                        <v-text-field class="mr-5" label="Search" v-model="search" prepend-inner-icon="fa-search"/>
                        <!-- <v-btn outlined color="primary" @click.stop='company_dialog = true'>
                            Add Company
                        </v-btn> -->
                    </v-card-title>
                    <v-data-table :headers="headers" :items="companies" :search="search">
                        <template v-slot:item.id="{ item }">
                            {{ companies.map(function(x) {return x.id; }).indexOf(item.id) + 1}}
                        </template>
                        <template v-slot:item.charity.name="{ item }">
                            <span v-if="item.charity != undefined">{{item.charity.name}}</span>
                            <span v-else>None</span>
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon medium color="green" @click="approve_company(item)" v-if="item.status=='Pending'">
                                fa-check
                            </v-icon>
                            <v-icon medium color="red" @click="reject_company(item)" v-if="item.status=='Pending'">
                                fa-times
                            </v-icon>
                            <!-- <v-icon medium color="blue" @click="open_update_company_dialog(item)">
                                fa-pen
                            </v-icon>
                            <v-icon medium color="red" @click="delete_company(item)">
                                fa-trash
                            </v-icon> -->
                        </template>
                    </v-data-table>
                </v-card>
                <!-- <v-dialog v-model="company_dialog" persistent max-width="700px">
                    <v-card>
                        <v-card-title class="headline" column>
                            <p display-3 v-show="!edit_mode">New Company Information</p>
                            <p display-3 v-show="edit_mode">Update Company Information</p>
                            <v-spacer></v-spacer>
                            <v-btn small fab @click="reset_data">
                            <v-icon>fa-times</v-icon>
                            </v-btn>
                        </v-card-title>
                        <v-card-text column align-center>
                            <v-container grid-list-sm bt-0>
                                <v-layout row wrap>
                                    <v-flex xs12 md12 lg12 v-if="!edit_mode">
                                        <v-layout row wrap>
                                            <v-flex xs12 md3>
                                                <v-text-field class="purple-input" type="text" label="Last Name" v-model="company_details.lastname" required autofocus prepend-inner-icon="fa-user-circle"/>
                                            </v-flex>
                                            <v-flex xs12 md3>
                                                <v-text-field class="purple-input" type="text" label="First Name" v-model="company_details.firstname" required />
                                            </v-flex>
                                            <v-flex xs12 md3>
                                                <v-text-field class="purple-input" type="text" label="Middle Name" v-model="company_details.middlename" />
                                            </v-flex>
                                            <v-flex xs12 md3>
                                                <v-text-field class="purple-input" type="text" label="Extension Name" v-model="company_details.name_extension" />
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                    <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Username" v-model="company_details.username" required prepend-inner-icon="fa-at"/>
                                    </v-flex>
                                    <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Password" v-model="company_details.password" :append-icon="show_password ? 'fa-eye' : 'fa-eye-slash'" :type="show_password ? 'text' : 'password'" @click:append="show_password = !show_password"/>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn v-show="!edit_mode" color="green darken-1" text @click="add_company">Save</v-btn>
                            <v-btn v-show="edit_mode" color="green darken-1" text @click="update_company" >Update</v-btn>
                            <v-btn type="button" color="red darken-1" text @click="reset_data">Close</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog> -->
            </v-container>
        </v-flex>
    </v-layout>
</template>
<script>
    export default {
        data: () => ({
            // company_dialog: false,
            // edit_mode: false,
            // show_password: false,
            search: '',
            companies: [],
            // company_details: {
            //     id: '',
            //     lastname: '',
            //     firstname: '',
            //     middlename: '',
            //     name_extension: '',
            //     username: '',
            //     password: '123456789'
            // },
            headers: [
                {text: '#', value: 'id'},
                {text: 'Name', value: 'name'},
                {text: 'Address', value: 'user.address'},
                {text: 'Contact Number', value: 'user.contact_number'},
                {text: 'Partnered Charity', value: 'charity.name'},
                {text: 'Handler Name', value: 'user.name'},
                {text: 'Handler Email', value: 'user.email'},
                {text: 'Status', value: 'status'},
                {text: 'Points', value: 'points'},
                {text: 'Actions', value: 'actions', align: 'right', sortable: false},
            ],
        }),
        methods: {
            approve_company(item) {
                axios.put('/api/approve-company/' + item.id).then(response => {
                    swal.fire(
                        'Success!',
                        'Successfully approved company',
                        'success'
                    )
                    this.get_companies()
                    this.reset_data()
                })
            },
            reject_company(item) {
                axios.put('/api/reject-company/' + item.id).then(response => {
                    swal.fire(
                        'Success!',
                        'Successfully rejected company',
                        'success'
                    )
                    this.get_companies()
                    this.reset_data()
                })
            },
            // open_update_company_dialog(item) {
            //     this.company_details = {
            //         id: item.id,
            //         lastname: item.lastname,
            //         firstname: item.firstname,
            //         middlename: item.middlename,
            //         name_extension: item.name_extension,
            //         username: item.user.username,
            //         password: ''
            //     }
            //     this.company_dialog = true
            //     this.edit_mode = true
            // },
            // reset_data() {
            //     this.company_dialog = false
            //     this.edit_mode = false
            //     this.company_details= {
            //         id: '',
            //         lastname: '',
            //         firstname: '',
            //         middlename: '',
            //         name_extension: '',
            //         username: '',
            //         password: '123456789'
            //     }
            // },
            // add_company() {
            //     axios.post('/api/create_company',{
            //         company_details: this.company_details
            //     }).then(response => {
            //         if (response.data.success) {
            //             swal.fire(
            //                 'Success!',
            //                 'Successfully added company',
            //                 'success'
            //             )
            //             this.get_companies()
            //             this.reset_data()
            //         }
            //     })
            // },
            // update_company() {
            //     axios.put('/api/update_company',{
            //         company_details: this.company_details
            //     }).then(response => {
            //         if (response.data.success) {
            //             this.get_companies()
            //             this.reset_data()
            //         }
            //     })
            // },
            // delete_company(item) {
            //     axios.delete('/api/delete_company',{
            //         params: {
            //             id: item.id
            //         }
            //     }).then(() => {
            //         this.get_companies()
            //         this.reset_data()
            //     })
            // },
            get_companies() {
                axios.get('/api/get_companies').then(response => {
                    this.companies = response.data
                })
            }
        },
        created() {
            this.get_companies()
        },
        beforeRouteEnter (to, from, next) {
            // if(localStorage.getItem('user-type') != 'Branch'){
            //     return next('dashboard')
            // }
            next();
        }
    }
</script>