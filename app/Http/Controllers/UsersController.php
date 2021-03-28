<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        $pages = $user->pages()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'pages' => $pages
        ]);
    }
    
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $user = \App\User::findOrFail($id);
        $pages = $user->pages();
        $reviews = $user->reviews();
        

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $user->id) {
            $reviews->delete();
            $pages->delete();
            $user->delete();
        }

        return redirect('/');
    }
}
