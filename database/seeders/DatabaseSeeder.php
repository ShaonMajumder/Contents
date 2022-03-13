<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $account_type = Account::create([
            'name' => 'admin'
        ]);

        $account_type_2 = Account::create([
            'name' => 'user'
        ]);

        $global_password = env('APP_GLOBAL_PASSWORD');
        User::create([
            "name" => "Global Admin",
            "email" => "admin@admin.com",
            "password" => bcrypt($global_password),
            "account_type" => $account_type->id
        ]);

        User::factory(10)->create();
    }
}
