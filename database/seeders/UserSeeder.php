<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    function __construct($account_types)
    {
        $this->account_types = $account_types;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $global_password = env('APP_GLOBAL_PASSWORD');

        $users = [
            [
                "name" => "Shaon Majumder",
                "email" => "smazoomder@gmail.com",
                "password" => bcrypt($global_password),
                "account_type" => 1
            ],
            [
                "name" => "Global Admin",
                "email" => "admin@admin.com",
                "password" => bcrypt($global_password),
                "account_type" => 1
            ]
        ];

        User::insert($users);
        User::factory(10)->create();
    }
}
