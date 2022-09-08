<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->count(1)
            ->create()
            ->each(
                function($user){
                    $user->assignRole('super-admin');
                }
            );

        User::factory()->count(2)
            ->create()
            ->each(
                function($user){
                    $user->assignRole('finance-manager');
                }
            );

        User::factory()->count(3)
            ->create()
            ->each(
                function($user){
                    $user->assignRole('reseller');
                }
            );
    }
}
