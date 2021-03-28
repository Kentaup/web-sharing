<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DOMDocument;
use DOMXPath;
use App\Page;

class PagesController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            // 全て投稿の一覧を作成日時の降順で取得
            $pages = \App\Page::orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'pages' => $pages
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
    
    public function mine()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            $pages = $user->pages()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'pages' => $pages,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
    
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $query = Page::query();
        
        if (isset($keyword)) {
            $query->where('title', 'like', '%' . self::escapeLike($keyword) . '%');
        }
        
        $pages = $query->orderBy('created_at', 'desc')->paginate(10);
        
        $data = [
                'pages' => $pages,
                'keyword' => $keyword,
            ];
    
        return view('welcome', $data);
    }
    
    //「\\」「%」「_」などの記号を文字としてエスケープさせる
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }
    
    public function show($id)
    {
        // idの値で投稿を検索して取得
        $page = Page::findOrFail($id);
        
        $reviews = $page->reviews()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'page' => $page,
            'reviews' => $reviews
        ];

        // ユーザ詳細ビューでそれを表示
        return view('pages.show', $data);
    }
    
    public function create(){
        $page = new Page;
        
        return view('pages.create',[
            'page' => $page,
            ]);
    }
    
     public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'url' => 'required',
            'content' => 'required|max:255',
        ]);
        
        $user = \Auth::user();
        
        // メッセージを作成
        $page = new Page;
        $page->user_id = $user->id;
        $page->url = $request->url;
        $page->content = $request->content;
       
        // タイトル取得
        $html = mb_convert_encoding(file_get_contents($page->url), "utf-8", "auto");
        preg_match('@<title>(.*)</title>@', $html, $result);
        $title = $result[1];
        if($title->length > 0){
            $page->title = $title;
        }else{
            $page->title = null;
        }
        
        
        //サムネイル取得
        //DOMDocumentとDOMXpathの作成
        $dom = new DOMDocument;
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);
        //XPathでmetaタグのog:imageを取得
        $node_image = $xpath->query('//meta[@property="og:image"]/@content');
        if ($node_image->length > 0) {
        	//タグが存在すればサムネイルを表示してリンクする
        	$thumbnail = $node_image->item(0)->nodeValue;
        }else{
            $thumbnail = null;
        }
        
        
        $page->thumbnail= $thumbnail;
        $page->save();
        
        return redirect('/');
    }
    
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $page = \App\Page::findOrFail($id);
        $reviews = $page->reviews();

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $page->user_id) {
            $reviews->delete();
            $page->delete();
        }

        return redirect('/');
    }
}
