<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectCategory;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // カテゴリーを取得
        $categories = ProjectCategory::all();

        // サンプルデータを作成
        Project::create([
            'name' => '施工事例1',
            'category_id' => $categories->random()->id, // ランダムなカテゴリーを設定
            'start_date' => '2023-01-01',
            'content' => '施工事例1の内容です。',
            'memo' => '施工事例1のメモです。',
        ]);

        Project::create([
            'name' => '施工事例2',
            'category_id' => $categories->random()->id,
            'start_date' => '2023-02-01',
            'content' => '施工事例2の内容です。',
            'memo' => '施工事例2のメモです。',
        ]);

        Project::create([
            'name' => '施工事例3',
            'category_id' => $categories->random()->id,
            'start_date' => '2023-03-01',
            'content' => '施工事例3の内容です。',
            'memo' => '施工事例3のメモです。',
        ]);
    }
}
