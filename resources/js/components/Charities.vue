<template>
    <v-layout row>
        <v-flex xs12>
            <v-container class="px-7">
                <v-card>
                    <v-card-title>
                        <v-icon class="mr-2" color="primary">fa-heart</v-icon>
                        Charities
                        <v-spacer/>
                        <v-text-field class="mr-5" label="Search" v-model="search" prepend-inner-icon="fa-search"/>
                        <!-- <v-btn outlined color="primary" @click.stop='charity_dialog = true'>
                            Add Charity
                        </v-btn> -->
                    </v-card-title>
                    <v-data-table :headers="headers" :items="charities" :search="search" :loading="loading">
                        <template v-slot:item.id="{ item }">
                            {{ charities.map(function(x) {return x.id; }).indexOf(item.id) + 1}}
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon medium color="green" @click="approve_charity(item)" v-if="item.status=='Pending'">
                                fa-check
                            </v-icon>
                            <v-icon medium color="red" @click="reject_charity(item)" v-if="item.status=='Pending'">
                                fa-times
                            </v-icon>
                            <!-- <v-icon medium color="blue" @click="open_update_charity_dialog(item)">
                                fa-pen
                            </v-icon>
                            <v-icon medium color="red" @click="delete_charity(item)">
                                fa-trash
                            </v-icon> -->
                        </template>
                    </v-data-table>
                </v-card>
                <v-dialog v-model="charity_dialog" persistent max-width="700px">
                    <v-card>
                        <v-card-title class="headline" column>
                            <p display-3 v-show="!edit_mode">New Charity Information</p>
                            <p display-3 v-show="edit_mode">Update Charity Information</p>
                            <v-spacer></v-spacer>
                            <v-btn small fab @click="reset_data">
                            <v-icon>fa-times</v-icon>
                            </v-btn>
                        </v-card-title>
                        <v-card-text column align-center>
                            <v-container grid-list-sm bt-0>
                                <v-layout row wrap>
                                    <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Name" v-model="charity_details.name" required prepend-inner-icon="fa-user-circle"/>
                                    </v-flex>
                                    <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Username" v-model="charity_details.username" required prepend-inner-icon="fa-at"/>
                                    </v-flex>
                                    <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Email" v-model="charity_details.email" required prepend-inner-icon="fa-envelope"/>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn v-show="!edit_mode" color="green darken-1" text @click="add_charity">Save</v-btn>
                            <v-btn v-show="edit_mode" color="green darken-1" text @click="update_charity" >Update</v-btn>
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
            charity_dialog: false,
            edit_mode: false,
            loading: false,
            search: '',
            charities: [],
            charity_details: {
                id: '',
                name: '',
                email: '',
                username: '',
                role: 'Charity',
                password: '123456789'
            },
            headers: [
                {text: '#', value: 'id'},
                {text: 'Name', value: 'name'},
                {text: 'Address', value: 'user.address'},
                {text: 'Contact Number', value: 'user.contact_number'},
                {text: 'Handler Name', value: 'user.name'},
                {text: 'Handler Email', value: 'user.email'},
                {text: 'Status', value: 'status'},
                {text: 'Points', value: 'points'},
                {text: 'Actions', value: 'actions', align: 'right', sortable: false},
            ],
        }),
        methods: {
            open_update_charity_dialog(item) {
                this.charity_details = {
                    id: item.id,
                    name: item.name,
                    email: item.email,
                    username: item.username,
                    role: 'Charity',
                    password: '123456789'
                }
                this.charity_dialog = true
                this.edit_mode = true
            },
            reset_data() {
                this.charity_dialog = false
                this.edit_mode = false
                this.charity_details= {
                    id: '',
                    name: '',
                    email: '',
                    username: '',
                    role: 'Charity',
                    password: '123456789'
                }
            },
            approve_charity(item) {
                axios.put('/api/approve-charity/' + item.id).then(response => {
                    swal.fire(
                        'Success!',
                        'Successfully approved charity',
                        'success'
                    )
                    this.get_charities()
                    this.reset_data()
                })
            },
            reject_charity(item) {
                axios.put('/api/reject-charity/' + item.id).then(response => {
                    swal.fire(
                        'Success!',
                        'Successfully rejected charity',
                        'success'
                    )
                    this.get_charities()
                    this.reset_data()
                })
            },
            add_charity() {
                axios.post('/api/create_user',{
                    name: this.charity_details.name,
                    email: this.charity_details.email,
                    username: this.charity_details.username,
                    role: this.charity_details.role,
                    password: this.charity_details.password,
                    password_confirmation: this.charity_details.password,
                }).then(response => {
                    swal.fire(
                        'Success!',
                        'Successfully added charity',
                        'success'
                    )
                    this.get_charities()
                    this.reset_data()
                })
            },
            update_charity() {
                axios.put('/api/update_charity',{
                    charity_details: this.charity_details
                }).then(response => {
                    if (response.data.success) {
                        this.get_charities()
                        this.reset_data()
                    }
                })
            },
            delete_charity(item) {
                axios.delete('/api/delete_charity',{
                    params: {
                        id: item.id
                    }
                }).then(() => {
                    this.get_charities()
                    this.reset_data()
                })
            },
            get_charities() {
                axios.get('/api/charities').then(response => {
                    this.charities = response.data
                })
            }
        },
        created() {
            this.get_charities()
        },
        beforeRouteEnter (to, from, next) {
            // if(localStorage.getItem('user-type') != 'Branch'){
            //     return next('dashboard')
            // }
            next();
        }
    }
</script>