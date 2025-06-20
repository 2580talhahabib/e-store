<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     User::insert(
        [
            [
        'name'=> 'admin',
        'email'=>'admin@gmail.com',
        'is_admin'=>1,
        'country_code'=>'+92',
        'phone_number'=>'03420998438',
        'is_verified'=>1,
        'password'=>Hash::make(123)
     ],
    [
       'name'=> 'Talha Habib',
        'email'=>'tsab@gmail.com',
        'is_admin'=>0,
        'country_code'=>'+92',
        'phone_number'=>'03420998438',
        'is_verified'=>1,
        'password'=>Hash::make(123) 
    ]
        ]
        );
    }
}