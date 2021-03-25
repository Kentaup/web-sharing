<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'url','content'
        ];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * この投稿に書かれたレビュー。（Reviewモデルとの関係を定義）
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
