<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    use HasFactory;

    // フィールドを指定する 
    protected $fillable = ['project_id', 'file_path', 'file_type', 'original_name'];

    // プロジェクトを取得する
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
