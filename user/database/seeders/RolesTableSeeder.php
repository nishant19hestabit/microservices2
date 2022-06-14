<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            'name' => 'admin'
        ]);
        Roles::create([
            'name' => 'student'
        ]);
        Roles::create([
            'name' => 'teacher'
        ]);
    }
}
