<?php

use Illuminate\Database\Seeder;
use App\operacions;
class OperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('es_VE');

        for ($i = 0; $i < 500; $i++) {
            operacions::create([
                'quantitat' => rand(100, 1),
                'user' => rand(31, 2),
                'user' => rand(15, 1)
            ]);
        }
    }
}
