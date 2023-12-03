<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Rak;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Role::create([
            'role_name' => 'Super Admin'
        ]);
        \App\Models\Role::create([
            'role_name' => 'Staff'
        ]);
        \App\Models\Role::create([
            'role_name' => 'Member'
        ]);
        \App\Models\Rak::create([
            'kode_rak' => '1A1A',
            'lokasi' => 'Lantai 1'
        ]);
        \App\Models\User::create([
            'id' => IdGenerator::generate(['table' => 'users', 'length' => 8, 'prefix' => 'U' . date('y')]),
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' =>  Hash::make('admin1234'),
            'remember_token' => Str::random(10),
            'role_id' => 1,
        ]);
        \App\Models\User::factory(1)->create();
        \App\Models\User::factory(1)->create();
        \App\Models\User::factory(1)->create();
    }
}
