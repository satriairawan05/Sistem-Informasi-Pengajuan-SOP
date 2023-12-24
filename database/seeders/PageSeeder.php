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
