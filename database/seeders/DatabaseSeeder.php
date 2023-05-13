<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(10)->create();
//        $user= \App\Models\User::factory()->create([
//            'name' => 'Admin',
//            'email' => 'lan_admin@admin.com',
//            'password'=>bcrypt('password')
//        ]);
//        $user->roles()->attach([
//            'role_id'=>'1',
//        ]);
//        for ($i = 2000; $i <= 2023; $i++) {
//            \App\Models\Year::create([
//                'name' => $i,
//            ]);
//        }
        $this->call([
//             NationalitySeeder::class,
//                        NationalitiySeeder::class,
                        AppUserSeeder::class,
                         carTypesSeeder::class,
                         EducationsLevelSeeder::class,
                         CitySeeder::class,
                        CategorySeeder::class,
                        subCategorySeeder::class,
                        CatgeoryItemSeeder::class,
                        productSeeder::class,
                        productServiceSeeder::class,
                        FaqSeeder::class,
                        CouponSeeder::class,
                        UserSeeder::class,
                        YearSeeder::class
        ]);
    }
}
