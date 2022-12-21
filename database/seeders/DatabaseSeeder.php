<?php

/*
Un seeder alimenta la BD con datos de manera automatizada. 
- Para ejecutarlo, usar el comando 'php artisan db:seed'
- Para borrar los contenidos, usar el comando 'php artisan migrate:refresh'
- Para combinar los 2 anteriores (borra lo que haya y después ejecutar), usar 'php artisan migrate:refresh --seed'
*/

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Oferta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * para insertar datos en la db: php artisan db:seed
     * para borrar los datos anteriores: php artisan db:refresh
     * para migrar los datos: php artisan migrate:refresh --seed
     * @return void
     */
    public function run()
    {
        // método que crea 5 usuarios de prueba usando una factory (database/factories) que genera datos
        // \App\Models\User::factory(5)->create();

        // genera un usuario con unos campos determinados
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

         // ejecutar esto crearia un solo usuario con estos parámetros y el resto creados por el método fáctory
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


                // crear unas cuantas ofertas con datos aleatorios, pero con un user_id que procede de $user
                Oferta::factory(6)->create([
                    'user_id' => $user->id
                ]);
    }
}
