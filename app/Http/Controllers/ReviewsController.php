<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewsController extends Controller
{
     public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'comment' => 'required|max:255',
        ]);

        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->reviews()->create([
            'page_id' => $request->page_id,
            'stars' => $request->stars,
            'comment' => $request->comment,
        ]);

        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $page = \App\Page::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $page->user_id) {
            $page->delete();
        }

        // 前のURLへリダイレクトさせる
        return back();
    }
}
