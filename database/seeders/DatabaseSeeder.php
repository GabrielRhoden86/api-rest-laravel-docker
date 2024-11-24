<?php

namespace Database\Seeders;
use Database\Seeders\FornecedorSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(FornecedorSeeder::class); //php artisan db:seed

    }
}
