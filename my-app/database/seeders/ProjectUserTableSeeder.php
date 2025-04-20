<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 全プロジェクトを取得
        $projects = Project::all();
        
        // 担当者候補のユーザーを取得（管理者を除く）
        $users = User::where('email', 'not like', '%admin%')->get();
        
        // 各プロジェクトに1-3人のユーザーをランダムに割り当て
        foreach ($projects as $project) {
            // ランダムなユーザー数（1-3人）を決定
            $numberOfUsers = rand(1, 3);
            
            // ユーザーをランダムに選択
            $selectedUsers = $users->random($numberOfUsers);
            
            // プロジェクトにユーザーを紐付け
            $project->users()->attach($selectedUsers->pluck('id')->toArray());
        }
    }
}
