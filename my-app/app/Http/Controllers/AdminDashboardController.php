<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // 管理者ダッシュボードの表示
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
