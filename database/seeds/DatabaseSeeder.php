<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ZonaSeeder::class);
        $this->call(CompuertaSeeder::class);
        //$this->call(periodolectivoTableSeeder::class);
        //$this->call(qr_codesTableSeeder::class);
    }
}
