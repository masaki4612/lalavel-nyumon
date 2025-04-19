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
            'name' => 'プロジェクト1',
            'category_id' => $categories->random()->id, // ランダムなカテゴリーを設定
            'start_date' => '2023-01-01',
            'content' => 'プロジェクト1の内容です。',
            'memo' => 'プロジェクト1のメモです。',
        ]);

        Project::create([
            'name' => 'プロジェクト2',
            'category_id' => $categories->random()->id,
            'start_date' => '2023-02-01',
            'content' => 'プロジェクト2の内容です。',
            'memo' => 'プロジェクト2のメモです。',
        ]);

        Project::create([
            'name' => 'プロジェクト3',
            'category_id' => $categories->random()->id,
            'start_date' => '2023-03-01',
            'content' => 'プロジェクト3の内容です。',
            'memo' => 'プロジェクト3のメモです。',
        ]);
    }
}
