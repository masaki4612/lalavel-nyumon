<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectFile;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // プロジェクト一覧を表示する（カテゴリーとファイルも取得）
    public function index(Request $request)
    {
        $query = Project::with(['category', 'client']);
        
        // クライアントによる絞り込み
        if ($request->has('client_id') && $request->client_id) {
            $query->where('client_id', $request->client_id);
        }

        // クライアント名での検索
        if ($request->has('search') && $request->search) {
            $query->whereHas('client', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $projects = $query->latest()->paginate(10);
        
        // 検索用に全クライアントデータを取得（必要な項目のみ）
        $clients = Client::select('id', 'name')->get();

        if ($request->ajax()) {
            return response()->json([
                'clients' => $clients
            ]);
        }

        return view('projects.index', compact('projects', 'clients'));
    }

    // プロジェクトを作成する
    public function create(Request $request)
    {
        $categories = ProjectCategory::all();
        $selectedClient = null;
        $clients = collect();
        $users = User::orderBy('name')->get();

        if ($request->has('client_id')) {
            $selectedClient = Client::findOrFail($request->client_id);
        } else {
            $clients = Client::all();
        }

        return view('projects.create', compact('categories', 'clients', 'selectedClient', 'users'));
    }

    // プロジェクトを保存する
    public function store(Request $request)
    {
        // バリデーション   
        $request->validate([
            'name' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'content' => 'required|string',
            'memo' => 'nullable|string',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id'
        ]);

        // プロジェクトを保存する
        $project = Project::create($request->only([
            'name',
            'client_id',
            'category_id',
            'start_date',
            'content',
            'memo'
        ]));

        // ユーザーを紐付ける
        if ($request->has('users')) {
            $project->users()->attach($request->users);
        }

        return redirect()->route('projects.index')
                        ->with('success', 'プロジェクトを作成しました');
    }

    // プロジェクトを表示する
    public function show(Project $project)
    {
        // プロジェクトに関連するカテゴリー、クライアント、ファイル情報を取得
        $project->load(['category', 'client', 'files']);
        
        return view('projects.show', compact('project'));
    }

    // プロジェクトを編集する
    public function edit(Project $project)
    {
        $categories = ProjectCategory::all();
        $clients = Client::all();
        $users = User::orderBy('name')->get();
        return view('projects.edit', compact('project', 'categories', 'clients', 'users'));
    }

    // プロジェクトを更新する
    public function update(Request $request, Project $project)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'category_id' => 'required|exists:project_categories,id',
            'start_date' => 'required|date',
            'content' => 'required|string',
            'memo' => 'nullable|string',
            'users' => 'nullable|array',
            'users.*' => 'exists:users,id'
        ]);

        // プロジェクトを更新
        $project->update($request->only([
            'name',
            'client_id',
            'category_id',
            'start_date',
            'content',
            'memo'
        ]));

        // ユーザーを紐付ける
        if ($request->has('users')) {
            $project->users()->sync($request->users);
        } else {
            $project->users()->detach();
        }

        return redirect()->route('projects.show', $project)
                        ->with('success', 'プロジェクトを更新しました');
    }

    public function destroy(Project $project)
    {
        // 関連するファイルを物理的に削除
        foreach ($project->files as $file) {
            // ストレージから物理的にファイルを削除
            Storage::disk('public')->delete($file->file_path);
        }

        // プロジェクトを削除（関連するファイルレコードは外部キー制約により自動的に削除される）
        $project->delete();

        return redirect()->route('projects.index')
                        ->with('success', 'プロジェクトを削除しました');
    }
}
