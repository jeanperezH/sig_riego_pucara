<?php

use Illuminate\Database\Seeder;

class CompuertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=3;$i++){
            if($i==1){
                for($j=1;$j<=2;$j++){
                    DB::table('compuertas')->insert([
                        'id_zona'       => $i,
                        'compuerta'   =>  'válbula '.$j,
                        'start_at' => '00:00:00',
                        'end_at' => '00:00:00',
                        'dias' => str_random(10)
                    ]);
                }
            } elseif ($i==2){
                for($j=1;$j<=6;$j++){
                    DB::table('compuertas')->insert([
                        'id_zona'       => $i,
                        'compuerta'   =>  'válbula '.$j,
                        'start_at' => '00:00:00',
                        'end_at' => '00:00:00',
                        'dias' => str_random(10)
                    ]);
                }
            } elseif ($i==3){
                for($j=1;$j<=5;$j++){
                    DB::table('compuertas')->insert([
                        'id_zona'       => $i,
                        'compuerta'   =>  'válbula '.$j,
                        'start_at' => '00:00:00',
                        'end_at' => '00:00:00',
                        'dias' => str_random(10)
                    ]);
                }
            }
            
        }
    }
}
