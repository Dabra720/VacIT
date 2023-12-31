<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Joboffer>
 */
class JobofferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // enum Level{
        //     case Junior;
        //     case Medior;
        //     case Senior;
        // }

        return [
            'date' => $this->faker->date(),
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraphs(2, true),
            'level' => $this->faker->randomElement(['Junior', 'Medior', 'Senior']),
            'company_id' =>$this->faker->numberBetween(1, 5)
        ];
    }
}
