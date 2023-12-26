<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SOP
        \App\Models\Page::create([
            'page_name' => 'SOP',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'SOP',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'SOP',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'SOP',
            'action' => 'Delete',
        ]);

        // Interaksi Kerja
        \App\Models\Page::create([
            'page_name' => 'Interaksi Kerja',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Interaksi Kerja',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Interaksi Kerja',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Interaksi Kerja',
            'action' => 'Delete',
        ]);

        // Formulir
        \App\Models\Page::create([
            'page_name' => 'Formulir',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Formulir',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Formulir',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Formulir',
            'action' => 'Delete',
        ]);

        // JSA
        \App\Models\Page::create([
            'page_name' => 'JSA',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'JSA',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'JSA',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'JSA',
            'action' => 'Delete',
        ]);

        // IBPR
        \App\Models\Page::create([
            'page_name' => 'IBPR',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'IBPR',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'IBPR',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'IBPR',
            'action' => 'Delete',
        ]);

        // Departemen
        \App\Models\Page::create([
            'page_name' => 'Departemen',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Departemen',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Departemen',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'Departemen',
            'action' => 'Delete',
        ]);

        // Account
        \App\Models\Page::create([
            'page_name' => 'User',
            'action' => 'Create',
        ]);

        \App\Models\Page::create([
            'page_name' => 'User',
            'action' => 'Read',
        ]);

        \App\Models\Page::create([
            'page_name' => 'User',
            'action' => 'Update',
        ]);

        \App\Models\Page::create([
            'page_name' => 'User',
            'action' => 'Delete',
        ]);
    }
}
