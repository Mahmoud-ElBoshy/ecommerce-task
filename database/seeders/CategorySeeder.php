<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id'=>'1','name'=>'Books'],
            ['id'=>'2','name'=>'Electronics'],
        ];
        DB::table('categories')->insert($data);
    }
}
