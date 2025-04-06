<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
/*
ユーザー管理の処理
*/
class UserController extends Controller
{
    // ユーザー一覧の表示
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    
    
    
}
