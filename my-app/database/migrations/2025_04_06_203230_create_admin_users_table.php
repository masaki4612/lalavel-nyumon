<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 管理者ユーザーテーブルを作成するマイグレーション
 * 
 * 主な仕様:
 * - 管理者のユーザー名、メールアドレス、パスワードを保存
 * - 作成日時と更新日時を記録
 * 
 * 制限事項:
 * - パスワードはハッシュ化して保存する必要がある
 */

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users');
    }
};
