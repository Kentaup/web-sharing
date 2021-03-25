<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Review;

class Review extends Model
{
    protected $fillable = ['stars','comment','page_id'];
    /**
     * このレビューを書いたユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * このレビューが書かれた投稿。（ Pageモデルとの関係を定義）
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
