<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'=>'Admin',
            'email'=>'admin@me.com',
            'username'=>'admin',
            'photo'=>'carita/profile_picture.png',
            'password'=>bcrypt('aaaaaaaa'),
            'role'=>"Administrator",
            'points'=>0,
            
        ]);
    }
}
