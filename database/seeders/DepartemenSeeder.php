<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Departemen::create([
            'departemen_nama' => 'Human Safety Environment'
        ]);

        \App\Models\Departemen::create([
            'departemen_nama' => 'Human Resource Development & General Affair'
        ]);

        \App\Models\Departemen::create([
            'departemen_nama' => 'Mine Operation'
        ]);

        \App\Models\Departemen::create([
            'departemen_nama' => 'Logistic'
        ]);

        \App\Models\Departemen::create([
            'departemen_nama' => 'Plant'
        ]);

        \App\Models\Departemen::create([
            'departemen_nama' => 'Finance'
        ]);

        \App\Models\Departemen::create([
            'departemen_nama' => 'TAX'
        ]);

        \App\Models\Departemen::create([
            'departemen_nama' => 'Geologi & Explorasi'
        ]);

        \App\Models\Departemen::create([
            'departemen_nama' => 'Barging & Shipping'
        ]);

        \App\Models\Departemen::create([
            'departemen_nama' => 'Production'
        ]);
    }
}
