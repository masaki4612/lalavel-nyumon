<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * クライアントテーブルを作成
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('クライアント名');
            $table->string('url')->nullable()->comment('URL');
            $table->string('phone')->nullable()->comment('電話番号');
            $table->string('address')->nullable()->comment('住所');
            $table->text('notes')->nullable()->comment('備考');
            $table->timestamps();
            $table->softDeletes(); // 論理削除用
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
}; 