<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Session;
use App\Models\User;
use Database\Factories\SessionFactory;
use Database\Factories\UserFactory;
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
        Customer::factory(2)->create();

        User::factory()->createMany(UserFactory::usersData());

        Session::factory()->createMany(SessionFactory::sessionData());
    }
}
