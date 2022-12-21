<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/*
Esta clase se ha creado con el comando ' php artisan make:factory OfertaFactory'
Es una clase para poder fabricar notas en serie desde un seeder. Estas notas utilizan 'dummy text' generado con el método faker, mientras que otros los podemos hacer manualmente
*/

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Oferta>
 */
class OfertaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' =>$this->faker->sentence(),
            'tags' =>'laravel, api, backend',
            'company' =>$this->faker->company(),
            'location' =>$this->faker->city(),
            'email' =>$this->faker->companyEmail(),
            'website' =>$this->faker->url(),
            'description' =>$this->faker->paragraph(5),
        ];
    }
}
