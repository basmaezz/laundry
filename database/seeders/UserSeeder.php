<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->id = 1;
        $user->name = 'Brian G';
        $user->last_name = 'aaaa';
        $user->email = 'example@gmail.com';
        $user->address = 'egypt';
        $user->lat = 28.419080483423105;
        $user->lng = 30.769525475673113;
        $user->phone = 123456789;
        $user->avatar = 'default.png';
        $user->arrears = '0';
        $user->city_id = 1;
        $user->active = '1';
        $user->confirm = '0';
        $user->notification = '0';
        $user->role = 1;
        $user->jwt_token = 'fcm_token';
        $user->user_type = 'admin';
        $user->urgent = '0';
        $user->price_urgent = '0';
        $user->delivery_price = '20';
        $user->password = bcrypt('password');
        $user->save();
//        $user->roles()->attach([ $roles['admin'] ]);

    }
}
