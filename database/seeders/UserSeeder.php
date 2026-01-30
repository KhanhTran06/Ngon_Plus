<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. TÀI KHOẢN CHỦ QUÁN (Role = 2)
        User::create([
            'name' => 'Chủ Quán (Admin)',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '0909000111',
            'address' => 'Đà Nẵng',
            'role' => 2,
            'job_title' => 'Chủ cửa hàng'
        ]);

        // 2. TÀI KHOẢN NHÂN VIÊN (Role = 1)
        User::create([
            'name' => 'Nhân Viên Pha Chế',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '0909000222',
            'address' => 'Hải Châu, Đà Nẵng',
            'role' => 1,
            'job_title' => 'Pha chế'
        ]);

        // 3. TÀI KHOẢN KHÁCH HÀNG (Role = 0)
        User::create([
            'name' => 'Khách Hàng Thân Thiết',
            'email' => 'khach@gmail.com',
            'password' => Hash::make('123456'),
            'phone' => '0909000333',
            'address' => 'Sơn Trà, Đà Nẵng',
            'role' => 0
        ]);
    }
}
