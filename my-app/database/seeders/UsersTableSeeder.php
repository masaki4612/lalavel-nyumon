<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // サンプルユーザーを作成
        User::create([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'phone_number' => '090-1234-5678',
            'password' => Hash::make('password'), // パスワードはハッシュ化
        ]);

        User::create([
            'name' => 'ユーザー1',
            'email' => 'user1@example.com',
            'phone_number' => '090-2345-6789',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'ユーザー2',
            'email' => 'user2@example.com',
            'phone_number' => '090-3456-7890',
            'password' => Hash::make('password'),
        ]);
    }
}
