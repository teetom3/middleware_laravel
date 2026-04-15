<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'view dashboard']);
        $adminRole->givePermissionTo($permission);

        $admin = User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');

        $user = User::factory()->create([
            'name'     => 'User',
            'email'    => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        Product::factory()->count(3)->create(['user_id' => $admin->id]);
        Product::factory()->count(3)->create(['user_id' => $user->id]);
    }
}
