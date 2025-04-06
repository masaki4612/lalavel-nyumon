<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // ファクトリーを使用する
    use HasFactory;

    // フィールドを指定する
    protected $fillable = ['name', 'category_id', 'start_date', 'content', 'memo'];

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
}
