<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Nishant',
            'email' => 'nishant@admin.com',
            'password' => Hash::make(12345678),
            'address'=>null,
            'profile_picture'=>null,
            'current_school'=>null,
            'previous_school'=>null,
            'role_id'=>1,
            'teacher_assigned'=>null,
        ]);
    }
}
