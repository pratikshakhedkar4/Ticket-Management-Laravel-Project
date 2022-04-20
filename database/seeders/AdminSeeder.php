<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name'=>'Admin',
            'last_name'=>'admin',
            'email'=>'pratikshakhedkar4@gmail.com',
            'password'=>Hash::make('admin@123'),
            'status'=>'active',
            'role'=>'admin',
            'mobile'=>'7721867565'
        ]);
    }
}
