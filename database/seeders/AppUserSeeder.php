<?php

namespace Database\Seeders;
use App\Models\AppUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppUser::create([
            'uuid' => "ahf54sshs45dcdc",
            'name' => 'Ahmed Ibrahim',
            'mobile' => '014123456789',
            'email' => 'example@gmail.com',
            'address' => 'egypt',
            'lat' => 28.419080483423105,
            'lng' => 30.769525475673113,
            'gender' => 'm',
            'status' => 'active',
            'image' => 'default.png',
            'city_id' => 1,
            'region_name' => 'El Mina',
            'building' => '502',
            'password' => bcrypt('password'),
        ]);

        AppUser::create([
            'uuid' => "ahf54sshs45dcdd",
            'name' => 'Ahmed Hamdy',
            'mobile' => '966566666665',
            'email' => 'hady@gmail.com',
            'address' => 'Mati city - Elmina - Egypt',
            'lat' => 30.2985033,
            'lng' => 31.1522995,
            'gender' => 'm',
            'status' => 'active',
            'image' => null,
            'city_id' => 1,
            'region_name' => 'Dakahlia',
            'building' => '502',
            'password' => bcrypt('password'),
        ]);

        AppUser::create([
            'uuid' => "ahf54sshs45dcda",
            'name' => 'احمد حمدي',
            'mobile' => '966566666666',
            'email' => 'ahmed@m.com',
            'address' => 'Ali zalata',
            'lat' => 30.298499,
            'lng' => 31.1523089,
            'gender' => 'm',
            'status' => 'active',
            'image' => null,
            'city_id' => 1,
            'region_name' => 'Mansoura',
            'building' => '58',
            'password' => bcrypt('password'),
        ]);

        AppUser::create([
            'uuid' => "ahf54sshs45dcdx",
            'name' => 'احمد حمدي',
            'mobile' => '966566666667',
            'email' => 'ag@b.vb',
            'address' => 'Ali zalata',
            'lat' => 30.2985103,
            'lng' => 31.1522772,
            'gender' => 'm',
            'status' => 'active',
            'image' => null,
            'city_id' => 1,
            'region_name' => 'Al Gharbia',
            'building' => '585',
            'password' => bcrypt('password'),
        ]);

        AppUser::create([
            'uuid' => "ahf54sshs45dcdw",
            'name' => 'Ahmed Ibrahim Kamal',
            'mobile' => '966566666669',
            'email' => 'hamdy7@gmail.com',
            'address' => 'Mati city - Elmina - Egypt',
            'lat' => 30.2984931,
            'lng' => 31.1523078,
            'gender' => 'm',
            'status' => 'active',
            'image' => null,
            'city_id' => 1,
            'region_name' => 'Qalyubia',
            'building' => '585',
            'password' => bcrypt('password'),
        ]);


        AppUser::create([
            'uuid' => "ahf54sshs45dcdq",
            'name' => 'Ahmed hamdy',
            'mobile' => '966566666668',
            'email' => 'hamdy@gmail.com',
            'address' => 'Mati city - Elmina - Egypt',
            'lat' => 30.2984931,
            'lng' => 31.1523078,
            'gender' => 'm',
            'status' => 'active',
            'image' => null,
            'city_id' => 1,
            'region_name' => 'Qalyubia',
            'building' => '585',
            'password' => bcrypt('password'),
        ]);
    }
}
