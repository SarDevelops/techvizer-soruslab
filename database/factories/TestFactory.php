<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $recommendedFor = [
            ['label' => 'Male'],
            ['label' => 'Female'],
            ['label' => 'Kids'],
            ['label' => 'Others'],
        ];

        $cbcTest = [
            ['symptom' => 'Weakness'],
            ['symptom' => 'Fatigue'],
            ['symptom' => 'Fever'],
            ['symptom' => 'Inflammation'],
            ['symptom' => 'Bruising'],
            ['symptom' => 'Bleeding'],
        ];

        $data = [
            'recommended_for' => $recommendedFor,
            'cbc_test' => $cbcTest,
        ];
        return [
            'name' => fake()->name(),
            'type' => fake()->name(),
            'recommended_for' => json_encode($data['recommended_for'], JSON_PRETTY_PRINT),
            'overview' => fake()->paragraph(),
            'cbc_test' => json_encode($data['cbc_test'], JSON_PRETTY_PRINT),
        ];
    }
}
