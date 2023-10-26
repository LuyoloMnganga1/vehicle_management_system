<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
            'title' => 'Mr.',
            'name' => 'Mxolisi',
            'surname'=> 'Poni',
            'id_no'=> '8809235678081',
            'gender' => 'Male',
            'email' => 'mxolisi.poni@ictchoice.co.za',
            'phone' => '+27795019522',
            'communication'=> 'Both',
            'apointment_date' => '2019-02-01',
            'department' => 'Software Development',
            'job_title' => 'Senior Software Developer',
            'role' => 'Admin',
            'location' => 'East London,Eastern Cape',
            'password' => Hash::make('password'),
            ],
        );
        DB::table('users')->insert(
            [
                'title' => 'Mr.',
                'name' => 'Luyolo',
                'surname'=> 'Mnganga',
                'id_no'=> '9807215678081',
                'gender' => 'Male',
                'email' => 'luyolo.mnganga@ictchoice.co.za',
                'phone' => '+27846542443',
                'communication'=> 'Both',
                'apointment_date' => '2019-02-01',
                'department' => 'Software Development',
                'job_title' => 'Intern Software Developer',
                'role' => ' Admin',
                'location' => 'East London,Eastern Cape',
                'password' => Hash::make('password'),
            ],
        );
            DB::table('users')->insert(
            [
                'title' => 'Mr.',
                'name' => 'Ayabonga',
                'surname'=> 'Maqashu',
                'id_no'=> '9604265678081',
                'gender' => 'Male',
                'email' => 'ayabonga.maqashu@ictchoice.co.za',
                'phone' => '+27739274369',
                'communication'=> 'Email',
                'apointment_date' => '2019-02-01',
                'department' => 'Business Development',
                'job_title' => 'Intern Business Developmentr',
                'role' => 'user',
                'location' => 'East London,Eastern Cape',
                'password' => Hash::make('password'),
            ],
        );
            DB::table('users')->insert(
            [
                'title' => 'Ms.',
                'name' => 'Nosisa',
                'surname'=> 'Zamxaka',
                'id_no'=> '8505050678081',
                'gender' => 'Female',
                'apointment_date' => '2019-02-01',
                'email' => 'nosisa.zamxaka@ictchoice.co.za',
                'phone' => '+27795019540',
                'communication'=> 'Email',
                'apointment_date' => '2019-02-01',
                'department' => 'Software Development',
                'job_title' => 'Junior Software Developer',
                'role' => 'department-head',
                'location' => 'East London,Eastern Cape',
                'password' => Hash::make('password'),
            ],
        );
            DB::table('users')->insert(
            [
                'title' => 'Ms.',
                'name' => 'Yolanda',
                'surname'=> 'Mlakuhlwa',
                'id_no'=> '9602140678081',
                'gender' => 'Female',
                'email' => 'yolanda.mlakuhlwa@ictchoice.co.za',
                'phone' => '+27814072566',
                'communication'=> 'Email',
                'apointment_date' => '2019-02-01',
                'department' => 'Business Development',
                'job_title' => 'Intern Graphic designer',
                'role' => 'department-head',
                'location' => 'East London,Eastern Cape',
                'password' => Hash::make('password'),
            ],
        );
            DB::table('users')->insert(
            [
                'title' => 'Mr.',
                'name' => 'Andile',
                'surname'=> 'Majiba',
                'id_no'=> '9406235678081',
                'gender' => 'Male',
                'email' => 'andile.majiba@ictchoice.co.za',
                'phone' => '+27834881325',
                'communication'=> 'Email',
                'apointment_date' => '2019-02-01',
                'department' => 'Technical Department',
                'job_title' => 'Intern Software Developer',
                'role' => 'user',
                'location' => 'East London,Eastern Cape',
                'password' => Hash::make('password'),
            ],
        );
            DB::table('users')->insert(
            [
                'title' => 'Mr.',
                'name' => 'Avile',
                'surname'=> 'Momoza',
                'id_no'=> '9202015678081',
                'gender' => 'Male',
                'email' => 'avile.momoza@ictchoice.co.za',
                'phone' => '+27834646845',
                'communication'=> 'Email',
                'apointment_date' => '2019-02-01',
                'department' => 'Technical Department',
                'job_title' => 'Intern Software Developer',
                'role' => 'department-head',
                'location' => 'East London,Eastern Cape',
                'password' => Hash::make('password'),
                ],
    );
    DB::table('users')->insert(
        [
            'title' => 'Ms.',
            'name' => 'Aphelele',
            'surname'=> 'Jara',
            'id_no'=> '9507060678081',
            'gender' => 'Female',
            'email' => 'aphelele.jara@ictchoice.co.za',
            'phone' => '+27834646845',
            'communication'=> 'Email',
            'apointment_date' => '2019-02-01',
            'job_title' => 'Intern Project Management',
            'department' => 'Project Management',
            'role' => 'user',
            'location' => 'East London,Eastern Cape',
            'password' => Hash::make('password'),
            ],
);
DB::table('users')->insert(
    [
        'title' => 'Mr.',
        'name' => 'Sydwell',
        'surname'=> 'Maqula',
        'id_no'=> '6208030678081',
        'gender' => 'Male',
        'email' => 'Sydwell.Maqula@ictchoice.co.za',
        'phone' => '+27834646845',
        'communication'=> 'Email',
        'apointment_date' => '2002-02-01',
        'job_title' => 'CEO',
        'department' => 'Executive Management',
        'role' => 'SuperAdmin',
        'location' => 'East London,Eastern Cape',
        'password' => Hash::make('password'),
        ],
);
DB::table('users')->insert(
    [
        'title' => 'Ms.',
        'name' => 'Thabelang',
        'surname'=> 'Mathe',
        'id_no'=> '6208030678081',
        'gender' => 'Female',
        'email' => 'thabelang.mathe@ictchoice.co.za',
        'phone' => '+27834646845',
        'communication'=> 'Email',
        'apointment_date' => '2008-02-01',
        'job_title' => 'Project Manager',
        'department' => 'Project Management',
        'role' => 'department-head',
        'location' => 'East London,Eastern Cape',
        'password' => Hash::make('password'),
        ],
);
    }
}
