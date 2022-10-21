<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('department')->insert([
            'name' => 'Software Development',
            'hod_fullname'=>'Avile Momoza',
            'phone'=>'0781768999'

        ]);
        DB::table('department')->insert([
            'name' => 'Business Development',
            'hod_fullname'=>'Sinazo Fenene',
            'phone'=>'0781768999'
        ]);
        DB::table('department')->insert([
            'name' => 'Project Management',
            'hod_fullname'=>'Aphelele Jara',
            'phone'=>'0781768999'
        ]);
        DB::table('department')->insert([
            'name' => 'Technical Department',
            'hod_fullname'=>'Sizwe Mbotyeni',
            'phone'=>'0781768999'
        ]);
        DB::table('department')->insert([
            'name' => 'Finance Department',
            'hod_fullname'=>'Andile Majiba',
            'phone'=>'0781768999'
        ]);
        DB::table('department')->insert([
            'name' => 'Executive Management',
            'hod_fullname'=>'Yolanda Mlakuhlwa',
            'phone'=>'0781768999'
        ]);

    }
}
