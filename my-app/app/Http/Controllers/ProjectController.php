<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectFile;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // プロジェクト一覧を表示する（カテゴリーとファイルも取得）
    public function index()
    {
        $projects = Project::with('category', 'files')->get();
        return view('projects.index', compact('projects'));
    }

    // プロジェクトを作成する
    public function create()
    {
        $categories = ProjectCategory::all();
        return view('projects.create', compact('categories'));
    }

    // プロジェクトを保存する
    public function store(Request $request)
    {
        // バリデーション   
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:project_categories,id',//
            'start_date' => 'required|date',
            'content' => 'required|string',
            'memo' => 'nullable|string',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,ppt,pptx',
        ]);

        // プロジェクトを保存する
        $project = Project::create($request->only(['name', 'category_id', 'start_date', 'content', 'memo']));

        // ファイルを保存する
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('projects', 'public');
                ProjectFile::create([
                    'project_id' => $project->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }
        return redirect()->route('projects.index');
    }
    
}
