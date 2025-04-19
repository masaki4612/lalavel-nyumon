<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // ファクトリーを使用する
    use HasFactory;

    // フィールドを指定する
    protected $fillable = [
        'name',
        'client_id',
        'category_id',
        'start_date',
        'content',
        'memo'
    ];

    // カテゴリーを取得する
    public function category()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    // ファイルを取得する
    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }

    /**
     * プロジェクトに関連するクライアントを取得
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
