<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = User::class;

    /**
     * @var array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
