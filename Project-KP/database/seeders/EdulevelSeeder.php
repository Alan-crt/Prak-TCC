<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EdulevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('edulevel')->insert([
            [
            'name' => 'SD sederajat',
            'desc' => 'SD/MI',
            ],
            [
                'name' => 'Smp',
                'desc' => 'SMA',
            ]
        ]);
    }
}
