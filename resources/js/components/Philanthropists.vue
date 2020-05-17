<template>
    <v-layout row>
        <v-flex xs12>
            <v-container class="px-7">
                <v-card>
                    <v-card-title>
                        <v-icon class="mr-2" color="primary">fa-users</v-icon>
                        Philanthropists
                        <v-spacer/>
                        <v-text-field class="mr-5" label="Search" v-model="search" prepend-inner-icon="fa-search"/>
                        <!-- <v-btn outlined color="primary" @click.stop='philanthropist_dialog = true'>
                            Add Philanthropist
                        </v-btn> -->
                    </v-card-title>
                    <v-data-table :headers="headers" :items="philanthropists" :search="search">
                        <template v-slot:item.id="{ item }">
                            {{ philanthropists.map(function(x) {return x.id; }).indexOf(item.id) + 1}}
                        </template>
                        <template v-slot:item.actions="{ item }">
                            <v-icon medium color="blue" @click="open_update_philanthropist_dialog(item)">
                                fa-pen
                            </v-icon>
                            <v-icon medium color="red" @click="delete_philanthropist(item)">
                                fa-trash
                            </v-icon>
                        </template>
                    </v-data-table>
                </v-card>
                <!-- <v-dialog v-model="philanthropist_dialog" persistent max-width="700px">
                    <v-card>
                        <v-card-title class="headline" column>
                            <p display-3 v-show="!edit_mode">New Philanthropist Information</p>
                            <p display-3 v-show="edit_mode">Update Philanthropist Information</p>
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
                                                <v-text-field class="purple-input" type="text" label="Last Name" v-model="philanthropist_details.lastname" required autofocus prepend-inner-icon="fa-user-circle"/>
                                            </v-flex>
                                            <v-flex xs12 md3>
                                                <v-text-field class="purple-input" type="text" label="First Name" v-model="philanthropist_details.firstname" required />
                                            </v-flex>
                                            <v-flex xs12 md3>
                                                <v-text-field class="purple-input" type="text" label="Middle Name" v-model="philanthropist_details.middlename" />
                                            </v-flex>
                                            <v-flex xs12 md3>
                                                <v-text-field class="purple-input" type="text" label="Extension Name" v-model="philanthropist_details.name_extension" />
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                    <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Username" v-model="philanthropist_details.username" required prepend-inner-icon="fa-at"/>
                                    </v-flex>
                                    <v-flex xs12 md12 lg12>
                                        <v-text-field class="purple-input" label="Password" v-model="philanthropist_details.password" :append-icon="show_password ? 'fa-eye' : 'fa-eye-slash'" :type="show_password ? 'text' : 'password'" @click:append="show_password = !show_password"/>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn v-show="!edit_mode" color="green darken-1" text @click="add_philanthropist">Save</v-btn>
                            <v-btn v-show="edit_mode" color="green darken-1" text @click="update_philanthropist" >Update</v-btn>
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
            // philanthropist_dialog: false,
            // edit_mode: false,
            // show_password: false,
            search: '',
            philanthropists: [],
            // philanthropist_details: {
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
                {text: 'Name', value: 'user.name'},
                {text: 'Username', value: 'username'},
                {text: 'Email', value: 'user.email'},
                {text: 'Contact Number', value: 'user.contact_number'},
                {text: 'Points', value: 'user.points'},
                {text: 'Actions', value: 'actions', sortable: false},
            ],
        }),
        methods: {
            // open_update_philanthropist_dialog(item) {
            //     this.philanthropist_details = {
            //         id: item.id,
            //         lastname: item.lastname,
            //         firstname: item.firstname,
            //         middlename: item.middlename,
            //         name_extension: item.name_extension,
            //         username: item.user.username,
            //         password: ''
            //     }
            //     this.philanthropist_dialog = true
            //     this.edit_mode = true
            // },
            // reset_data() {
            //     this.philanthropist_dialog = false
            //     this.edit_mode = false
            //     this.philanthropist_details= {
            //         id: '',
            //         lastname: '',
            //         firstname: '',
            //         middlename: '',
            //         name_extension: '',
            //         username: '',
            //         password: '123456789'
            //     }
            // },
            // add_philanthropist() {
            //     axios.post('/api/create_philanthropist',{
            //         philanthropist_details: this.philanthropist_details
            //     }).then(response => {
            //         if (response.data.success) {
            //             swal.fire(
            //                 'Success!',
            //                 'Successfully added philanthropist',
            //                 'success'
            //             )
            //             this.get_philanthropists()
            //             this.reset_data()
            //         }
            //     })
            // },
            // update_philanthropist() {
            //     axios.put('/api/update_philanthropist',{
            //         philanthropist_details: this.philanthropist_details
            //     }).then(response => {
            //         if (response.data.success) {
            //             this.get_philanthropists()
            //             this.reset_data()
            //         }
            //     })
            // },
            // delete_philanthropist(item) {
            //     axios.delete('/api/delete_philanthropist',{
            //         params: {
            //             id: item.id
            //         }
            //     }).then(() => {
            //         this.get_philanthropists()
            //         this.reset_data()
            //     })
            // },
            get_philanthropists() {
                axios.get('/api/get_philanthropists').then(response => {
                    this.philanthropists = response.data
                })
            }
        },
        created() {
            this.get_philanthropists()
        },
        beforeRouteEnter (to, from, next) {
            // if(localStorage.getItem('user-type') != 'Branch'){
            //     return next('dashboard')
            // }
            next();
        }
    }
</script>