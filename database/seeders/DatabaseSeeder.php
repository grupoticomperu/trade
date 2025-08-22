<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Combustible;
use App\Models\Crm;
use App\Models\Etapa;
use App\Models\Lead;
use App\Models\Modello;
use App\Models\Proveedor;
use App\Models\Tipomarketing;
use App\Models\Traccion;
use App\Models\Transmision;
use App\Models\User;
use App\Models\Version;
use App\Models\Year;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        $this->call(CurrencySeeder::class);
        $this->call(UserSeeder::class);

        Tipomarketing::create([
            'name' => 'whatsapp',
        ]);

        Tipomarketing::create([
            'name' => 'facebook',
        ]);


        Brand::create([
            'name' => 'Chevrolet',
        ]);
        Brand::create([
            'name' => 'Toyota',
        ]);
        Brand::create([
            'name' => 'Mazda',
        ]);
        Brand::create([
            'name' => 'Hyundai',
        ]);

        Modello::create([
            'name' => 'cruze',
            'brand_id' => 1
        ]);

        Modello::create([
            'name' => 'camaro',
            'brand_id' => 1
        ]);

        Modello::create([
            'name' => 'captiva',
            'brand_id' => 1
        ]);


        Version::create([
            'name' => 'ver-cruze1',
            'modello_id' => 1
        ]);

        Version::create([
            'name' => 'ver-cruze2',
            'modello_id' => 1
        ]);


        Version::create([
            'name' => 'ver-cruze3',
            'modello_id' => 1
        ]);

        Version::create([
            'name' => 'ver-camaro1',
            'modello_id' => 2
        ]);

        Version::create([
            'name' => 'ver-camaro2',
            'modello_id' => 2
        ]);

        Version::create([
            'name' => 'ver-camaro3',
            'modello_id' => 2
        ]);

        Version::create([
            'name' => 'ver-captiva1',
            'modello_id' => 3
        ]);

        Version::create([
            'name' => 'ver-captiva2',
            'modello_id' => 3
        ]);

        Version::create([
            'name' => 'ver-captiva3',
            'modello_id' => 3
        ]);

        Version::create([
            'name' => 'ver-captiva4',
            'modello_id' => 3
        ]);



        Proveedor::create([
            'nombre' => 'Luis Escajadillo Lopez',
            'telefono' => '996929478',
            'correo' => 'luis@gmail.com',
            'dni' => '10133429'
        ]);

        Etapa::create([
            'name' => 'etapa 1',
            'order' => 1,
        ]);

        Etapa::create([
            'name' => 'etapa 2',
            'order' => 2,
        ]);


        Etapa::create([
            'name' => 'etapa 3',
            'order' => 3,
        ]);

        Etapa::create([
            'name' => 'ganado',
            'order' => 4,
        ]);


        Lead::create([
            'nombres' => 'Jos camacho',
            'telefono' => '996587878',
            //'producto_id' => 1,
            'correoelectronico' => 'jose@gmail.com',
            'marca' => 'chevrolet',
            'modelo' => 'cruze',
            'anio' => '2018',
            'kilometraje' => '87654',
            'placa' => 'N12 GT5',
            'tipomarketing_id' => 1
        ]);


        Color::create([
            'name' => 'rojo',
        ]);
        Color::create([
            'name' => 'blanco',
        ]);
        Color::create([
            'name' => 'azul',
        ]);


        Year::create([
            'name' => '2000',
        ]);

        Year::create([
            'name' => '2001',
        ]);
        Year::create([
            'name' => '2002',
        ]);
        Traccion::create([
            'name' => '4x2',
        ]);
        Traccion::create([
            'name' => '4x4',
        ]);

        Transmision::create([
            'name' => 'Mecanica',
        ]);

        Transmision::create([
            'name' => 'Automática',
        ]);

        Combustible::create([
            'name' => 'Diesel',
        ]);

        Combustible::create([
            'name' => 'GLP',
        ]);

        Category::create([
            'name' => 'Auto',
            'slug' => 'auto',
        ]);

        Category::create([
            'name' => 'Deportivo',
            'slug' => 'deportivo',
        ]);

        Category::create([
            'name' => 'Vans',
            'slug' => 'vans',
        ]);

        /* Crm::create([
            'proveedor_id' => 1,
            'user_id' => 1,
           
            'etapa_id' => 1,
           
            'tipomarketing_id' => 1
        ]); */
        $this->call(DistritosTableSeeder::class);
    }
}
