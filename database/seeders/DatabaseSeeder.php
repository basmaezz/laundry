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
//         \App\Models\User::factory()->create([
//             'name' => 'Test',
//             'email' => 'admin@admin.com',
//             'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
//         ]);
        $this->call([
            AppUserSeeder::class,
             carTypesSeeder::class,
             EducationsLevelSeeder::class,
             CitySeeder::class,
            CategorySeeder::class,
            subCategorySeeder::class,
            CatgeoryItemSeeder::class,
            productSeeder::class,
            productServiceSeeder::class,
//            FaqSeeder::class,
            CouponSeeder::class,
            UserSeeder::class,
        ]);
    }
}
