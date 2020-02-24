<?php

use Illuminate\Database\Seeder;

class ContaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Conta::class, 10)->create();
    }
}
