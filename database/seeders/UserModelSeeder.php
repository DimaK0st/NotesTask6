<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<20;$i++){
        DB::table('user_models')->insert([
            'userName' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Str::random(20),
        ]);}
    }
}
