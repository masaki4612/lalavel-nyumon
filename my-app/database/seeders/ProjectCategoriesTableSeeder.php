<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;
class ProjectCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // サンプルカテゴリーを作成
        ProjectCategory::create(['name' => '住宅']);
        ProjectCategory::create(['name' => '商業']);
        ProjectCategory::create(['name' => '公共']);
        ProjectCategory::create(['name' => 'その他']);
    }
}
