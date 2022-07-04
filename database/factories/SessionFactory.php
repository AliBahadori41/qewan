<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
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

    public static function sessionData(): array
    {
        return [
            [
                'user_id' => 1,
                'activited' => null,
                'appointment' => '2021-01-22',
            ],
            [
                'user_id' => 2,
                'activited' => '2021-01-01',
                'appointment' => '2021-01-01',
            ],
            [
                'user_id' => 2,
                'activited' => '2021-02-01',
                'appointment' => null,
            ],
            [
                'user_id' => 4,
                'activited' => '2021-01-15',
                'appointment' => null,
            ],
            [
                'user_id' => 4,
                'activited' => '2021-01-16',
                'appointment' => null,
            ],
            [
                'user_id' => 4,
                'activited' => '2021-03-01',
                'appointment' => '2021-01-30',
            ],
            [
                'user_id' => 4,
                'activited' => null,
                'appointment' => '2021-01-30',
            ],
            [
                'user_id' => 8,
                'activited' => '2021-03-03',
                'appointment' => '2021-03-03',
            ],
            [
                'user_id' => 9,
                'activited' => null,
                'appointment' => '2020-12-22',
            ],
            [
                'user_id' => 10,
                'activited' => '2020-12-01',
                'appointment' => null,
            ],
            [
                'user_id' => 10,
                'activited' => '2020-12-02',
                'appointment' => null,
            ],
            [
                'user_id' => 10,
                'activited' => '2020-12-03',
                'appointment' => null,
            ],
            [
                'user_id' => 10,
                'activited' => null,
                'appointment' => '2021-01-04',
            ],
            [
                'user_id' => 3,
                'activited' => null,
                'appointment' => '2021-01-01',
            ],
            [
                'user_id' => 5,
                'activited' => null,
                'appointment' => '2021-04-01',
            ],
            [
                'user_id' => 5,
                'activited' => null,
                'appointment' => '2021-04-01',
            ],
        ];
    }
}
