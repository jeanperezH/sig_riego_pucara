<?php

use Illuminate\Database\Seeder;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=3;$i++){
            DB::table('zonas')->insert([
                'zona'          => 'Zona'.$i,
                'descripcion'   =>  str_random(10)
            ]);
        }
    }
}
