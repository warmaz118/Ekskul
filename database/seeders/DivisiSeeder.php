<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisiSeeder extends Seeder
{
    public function run()
    {
        DB::table('divisi')->insert([
            ['nama' => 'SMP'],
            ['nama' => 'SMA'],
        ]);
    }
}
