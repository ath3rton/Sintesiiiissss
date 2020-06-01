<?php

use Illuminate\Database\Seeder;
use App\empreses;
use App\denuncia;
use App\projectes;
use App\operacions;
use Overdesign\CifGenerator\Cif;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('es_VE');
        
        for ($i = 2; $i < 30; $i++) {
            empreses::create(['nom_empresa' => $faker->company,
                              'cif' => Cif::generate(),
                              'ciutat' => $faker->city,
                              'owner' => $i]);
        }
        for ($i = 2; $i < 17; $i++) {
            projectes::create(['nom_projecte' => $faker->company,
                               'descripcio' => $faker->sentence,
                               'feedback'=> $faker->sentence,
                               'objectiu'=> $faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max = 999999),
                               'fraccio'=> $faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max = 9999),
                               'estat'=> 'Creat',
                               'actiu'=> true,
                               'emp_id'=> $i]);
        }
        for ($i = 0; $i < 500; $i++) {
            operacions::create([
                'quantitat' => rand(100, 1),
                'user' => rand(29, 2),
                'projecte' => rand(15, 1)
            ]);
        }
    }
}
