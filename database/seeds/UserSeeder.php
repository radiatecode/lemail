<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'=>'noor alam',
                'email'=>'nur@gmail.com',
                'password'=>bcrypt('123456'),
                'photo'=>'male.png',
                'active'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'raj alam',
                'email'=>'raj@gmail.com',
                'password'=>bcrypt('123456'),
                'photo'=>'male.png',
                'active'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ],
            [
                'name'=>'ariyan',
                'email'=>'ariyan@gmail.com',
                'password'=>bcrypt('123456'),
                'photo'=>'male.png',
                'active'=>1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
            ]
        ]);
    }
}
