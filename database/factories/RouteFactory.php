<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Route;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Route::class;
    
    public function definition(): array
    {
       
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'user_id' => User::factory(), // crea un usuario asociado automáticamente
        ];
    }
}
