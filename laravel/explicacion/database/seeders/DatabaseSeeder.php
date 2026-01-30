<?php

namespace Database\Seeders;

use App\Models\Fruta;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        DB::table('frutas')->delete();
        Fruta::factory(10)->create();

        // Esto es meter a mano, no usando modelos
        // DB::table('frutas')->insert([
        //     'nombre' => 'Manzana',
        //     'color' => 'Roja',
        //     'precio' => 1.0,
        //     'pais_origen' => 'España',
        // ]);

        // DB::table('frutas')->insert([
        //     'nombre' => 'Pera',
        //     'color' => 'Verde',
        //     'precio' => 1.5,
        //     'pais_origen' => 'Italia',
        // ]);

        // DB::table('frutas')->insert([
        //     'nombre' => 'Naranja',
        //     'color' => 'Naranja',
        //     'precio' => 2.0,
        //     'pais_origen' => 'España',
        // ]);

        // DB::table('frutas')->insert([
        //     'nombre' => 'Plátano',
        //     'color' => 'Amarillo',
        //     'precio' => 2.5,
        //     'pais_origen' => 'Ecuador',
        // ]);

        // DB::table('frutas')->insert([
        //     'nombre' => 'Uva',
        //     'color' => 'Morada',
        //     'precio' => 3.0,
        //     'pais_origen' => 'España',
        // ]);

        // Esto es usando modelos
        // $f = new Fruta();
        // $f->nombre = 'Manzana';
        // $f->color = 'Roja';
        // $f->precio = 1.0;
        // $f->pais_origen = 'España';
        // $f->save();

        // $f = new Fruta();
        // $f->nombre = 'Pera';
        // $f->color = 'Verde';
        // $f->precio = 1.5;
        // $f->pais_origen = 'Italia';
        // $f->save();

        // $f = new Fruta();
        // $f->nombre = 'Naranja';
        // $f->color = 'Naranja';
        // $f->precio = 2.0;
        // $f->pais_origen = 'España';
        // $f->save();

        // $f = new Fruta();
        // $f->nombre = 'Plátano';
        // $f->color = 'Amarillo';
        // $f->precio = 2.5;
        // $f->pais_origen = 'Ecuador';
        // $f->save();

        // $f = new Fruta();
        // $f->nombre = 'Uva';
        // $f->color = 'Morada';
        // $f->precio = 3.0;
        // $f->pais_origen = 'España';
        // $f->save();
    }
}
