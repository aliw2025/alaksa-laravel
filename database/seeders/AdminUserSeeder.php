<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;



class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $user = User::create([
            'name' => 'admin',  
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $role = Role::create(['name' => 'admin']);
        $user->assignRole($role);

    }
}
