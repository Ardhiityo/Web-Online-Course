<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            "admin",
            "mentor",
            'student'
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }

        $user = User::create([
            "name"=> "admin",
            'email' => 'admin@test.com',
            'password' => '11111111'
        ]);

        $user->assignRole('admin');
    }
}
