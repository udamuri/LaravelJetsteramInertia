<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayData = [
            [
                'name' => 'Muri Budiman',
                'email' => 'admin@gmail.com',
                'password' => Hash::make("12345678"),
                'role' => "super-admin"
            ],
            [
                'name' => 'Operator',
                'email' => 'operator@gmail.com',
                'password' => Hash::make("12345678"),
                'role' => "operator"
			],

        ];
        
        foreach($arrayData as $key => $value) {
			$create = User::create($value);            
        }
    }
}
