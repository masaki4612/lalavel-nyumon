<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'name' => '株式会社テスト建設',
            'url' => 'https://example.com',
            'phone' => '03-1234-5678',
            'address' => '東京都渋谷区テスト1-1-1',
            'notes' => 'テストクライアント1'
        ]);

        Client::create([
            'name' => '株式会社サンプル不動産',
            'url' => 'https://example.com',
            'phone' => '03-2345-6789',
            'address' => '東京都新宿区サンプル2-2-2',
            'notes' => 'テストクライアント2'
        ]);
    }
}
