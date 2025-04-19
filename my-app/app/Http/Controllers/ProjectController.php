<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectFile;
use App\Models\Client;
use Illuminate\Http\Request;

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
        $clients = Client::orderBy('name')->get();

        if ($request->ajax()) {
            return response()->json([
                'clients' => $clients
            ]);
        }

        return view('projects.index', compact('projects', 'clients'));
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
