<?php 

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder {
    public function run():void {
        User::create([
            'name'=>'Admin User',
            'email' => 'admin@gym.com',
            'password' => Hash::make('123123'),
            'role'=>'admin',
        ]);
        User::create([
            'name' => 'Oualid',
            'email'=>'oualid@gym.com',
            'password'=>Hash::make('oualid123'),
            'role'=>'client',
        ]);
        echo "admin and client created succesfully";
        echo "admin : admin@gym.com / 123123";
        echo "admin : oualid@gym.com / oualid123";
    }
}