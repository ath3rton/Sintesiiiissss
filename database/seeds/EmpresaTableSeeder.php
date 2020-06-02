<?php

use Illuminate\Database\Seeder;
use App\empreses;
use App\denuncia;
use App\projectes;
use App\operacions;
use App\Users;
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
        
        // for ($i = 2; $i < 30; $i++) {
        //     empreses::create(['nom_empresa' => $faker->company,
        //                       'cif' => Cif::generate(),
        //                       'ciutat' => $faker->city,
        //                       'owner' => $i]);
        // }
        for ($i = 0; $i < 100000; $i++) {
            $emp = empreses::inRandomOrder()->get()->first();
            projectes::create(['nom_projecte' => $faker->company,
                               'descripcio' => $faker->sentence,
                               'feedback'=> $faker->sentence,
                               'objectiu'=> $faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max = 999999),
                               'fraccio'=> $faker->randomFloat($nbMaxDecimals = NULL, $min = 1, $max = 9999),
                               'estat'=> 'Obert',
                               'actiu'=> true,
                               'emp_id'=> $emp->id]);
        }
        // for ($i = 0; $i < 10000; $i++) {
        //     $proj = projectes::inRandomOrder()->get()->first();
        //     $emp = Users::inRandomOrder()->get()->first();
        //     operacions::create([
        //         'quantitat' => rand(200, 1),
        //         'user' => $emp->id,
        //         'projecte' => $proj->id
        //     ]);
        // }   
    }
}
