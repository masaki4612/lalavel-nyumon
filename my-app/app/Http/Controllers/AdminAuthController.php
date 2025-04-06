<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * 管理者認証コントローラー
 * 
 * 主な機能:
 * - 管理者ログインフォームの表示
 * - 管理者ログインの処理
 * - ログインエラーメッセージの表示
 */
class AdminAuthController extends Controller
{
    // 管理者ログインフォームの表示
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // 管理者ログインの処理
    public function login(Request $request)
    {
        // ログインフォームから送信されたメールアドレスとパスワードを取得
        $credentials = $request->only('email', 'password');

        // ログイン試行
        if (Auth::guard('admin')->attempt($credentials)) {
            // ログイン成功
            return redirect()->route('admin.dashboard');
        }

        // ログイン失敗
        return redirect()->back()->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています']);
    }

    // 管理者ダッシュボードの表示
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // 管理者ログアウトの処理
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
