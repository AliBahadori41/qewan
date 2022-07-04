<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [];
    }

    public static function usersData(): array
    {
        return [
            [
                'email' => 'user1@example.com',
                'customer_id' => 1,
                'created_at' => '2021-01-01',
            ],
            [
                'email' => 'user2@example.com',
                'customer_id' => 1,
                'created_at' => '2021-01-01',
            ],
            [
                'email' => 'user3@example.com',
                'customer_id' => 2,
                'created_at' => '2021-01-01',
            ],
            [
                'email' => 'user4@example.com',
                'customer_id' => 1,
                'created_at' => '2021-01-15',
            ],
            [
                'email' => 'user5@example.com',
                'customer_id' => 2,
                'created_at' => '2021-04-01',
            ],
            [
                'email' => 'user6@example.com',
                'customer_id' => 2,
                'created_at' => '2021-05-01',
            ],
            [
                'email' => 'user7@example.com',
                'customer_id' => 2,
                'created_at' => '2019-01-01',
            ],
            [
                'email' => 'user8@example.com',
                'customer_id' => 1,
                'created_at' => '2021-03-03',
            ],
            [
                'email' => 'user9@example.com',
                'customer_id' => 1,
                'created_at' => '2020-12-22',
            ],
            [
                'email' => 'user10@example.com',
                'customer_id' => 1,
                'created_at' => '2020-12-01',
            ],
        ];
    }
}
