<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        // 検索クエリがある場合
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%');
        }

        $clients = $query->latest()->paginate(10);
        
        // 検索用に全クライアントデータも取得
        $allClients = Client::select('id', 'name')->get();
        
        return view('clients.index', compact('clients', 'allClients'));
    }

    /**
     * Show the form for creating a new resource
     * 新規クライアント作成画面を表示
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     * 新規クライアント保存
     */
    public function store(Request $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255', 
            'notes' => 'nullable|string',
        ]);

        // クライアントを作成
        Client::create($validatedData);
        return redirect()->route('clients.index')->with('success', 'クライアントを登録しました');
    }

    /**
     * Display the specified resource.
     * クライアント詳細画面を表示
     */
    public function show(Client $client)
    {
        // クライアントを取得
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     * クライアント編集画面を表示
     */
    public function edit(Client $client)
    {
        // クライアントを取得
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     * クライアント更新
     */
    public function update(Request $request, Client $client)
    {
        // バリデーション
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $client->update($validatedData);

        // 更新後はクライアントの詳細ページにリダイレクト
        return redirect()->route('clients.show', $client)
                        ->with('success', 'クライアント情報を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     * クライアント削除
     */
    public function destroy(Client $client)
    {
        // クライアントを削除
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'クライアントを削除しました');
    }
}
