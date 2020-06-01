<?php

use Illuminate\Database\Seeder;
use App\Rols; 
use App\Users; 
use App\userinfo;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('es_VE');
        
        $rols = array('Admin','User','Visitor');

        for ($i = 0; $i < count($rols); $i++) {
            Rols::create([
                'rol_nom' => $rols[$i]
            ]);
        }
        $password = Hash::make('admin');
        Users::create([
            'user_mail' => 'admin@admin.com',
            'user_password' => $password,
            'rol' => 1
            
        ]);

        $password = Hash::make('user');

        for ($i = 2; $i < 30; $i++) {
            Users::create([
                'id' => $i,
                'user_mail' => $faker->email,
                'user_password' => $password,
                'rol' => 2
                
            ]);
            userinfo::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'nickname' => $faker->firstName,
                'dni' => $faker->numberBetween($min = 100000000, $max = 99999999),
                'usuari' => $i
            ]);
        }
    }
}

