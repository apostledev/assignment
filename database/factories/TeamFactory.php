<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Team::class;

    /**
     * @var array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}
