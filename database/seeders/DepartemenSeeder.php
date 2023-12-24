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
            'departemen_name' => 'Human Safety Environment'
        ]);

        \App\Models\Departemen::create([
            'departemen_name' => 'Human Resource Development & General Affair'
        ]);

        \App\Models\Departemen::create([
            'departemen_name' => 'Mine Operation'
        ]);

        \App\Models\Departemen::create([
            'departemen_name' => 'Logistic'
        ]);

        \App\Models\Departemen::create([
            'departemen_name' => 'Plant'
        ]);

        \App\Models\Departemen::create([
            'departemen_name' => 'Finance'
        ]);

        \App\Models\Departemen::create([
            'departemen_name' => 'TAX'
        ]);

        \App\Models\Departemen::create([
            'departemen_name' => 'Geologi & Explorasi'
        ]);

        \App\Models\Departemen::create([
            'departemen_name' => 'Barging & Shipping'
        ]);

        \App\Models\Departemen::create([
            'departemen_name' => 'Production'
        ]);
    }
}
