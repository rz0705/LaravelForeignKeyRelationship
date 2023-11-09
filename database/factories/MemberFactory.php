<?php

namespace Database\Factories;

use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // dd("ok");
        return [
            'name' => fake()->firstName(),
            'email' => fake()->email(),
            'contact' => rand(1000000000,9999999999),
            'group_id' => 1
        ];
    }
}
