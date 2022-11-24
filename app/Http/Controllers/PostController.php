<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nice;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ログインユーザー以外のアクセスを制限
    public function __construct(){
        $this->middleware('auth');
    }
    // 最新・自身・人気の献立を4個取得⇒表示
    public function index()
    {
        $user_id = Auth::id();
        $posts=Post::orderBy('created_at','desc')
        ->take(4)
        ->get();
        $MyPosts=Post::where('user_id', $user_id)
        ->orderBy('created_at','desc')
        ->take(4)
        ->get();
        $NicePosts = Post::withCount('nices')
        ->having('nices_count', '>', 0)
        ->orderBy('nices_count', 'desc')
        ->take(4)
        ->get();;
        return view('post.index',compact('posts','MyPosts','NicePosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 献立投稿画面へ遷移
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 献立投稿内容をDBに保存
    public function store(Request $request)
    {
        $inputs=$request->validate([
            'title'=>'required|max:20',
            'image'=>'required|image|max:1024',
            'food1'=>'required|max:10',
            'food2'=>'max:10',
            'food3'=>'max:10',
            'food4'=>'max:10',
            'food5'=>'max:10',
            'food6'=>'max:10',
            'food7'=>'max:10',
            'food8'=>'max:10',
            'food9'=>'max:10',
            'step1'=>'required|max:150',
            'step2'=>'max:150',
            'step3'=>'max:150',
            'step4'=>'max:150',
            'step5'=>'max:150',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->user_id = auth()->user()->id;
        $post->food1 = $request->food1;
        $post->food2 = $request->food2;
        $post->food3 = $request->food3;
        $post->food4 = $request->food4;
        $post->food5 = $request->food5;
        $post->food6 = $request->food6;
        $post->food7 = $request->food7;
        $post->food8 = $request->food8;
        $post->food9 = $request->food9;
        $post->step1 = $request->step1;
        $post->step2 = $request->step2;
        $post->step3 = $request->step3;
        $post->step4 = $request->step4;
        $post->step5 = $request->step5;
        // 画像保存
        $original = request()->file('image')->getClientOriginalName();
        $name = date('Ymd_His').'_'.$original;
        request()->file('image')->move('storage/images',$name);
        $post->image = $name;
        $post->save();
        return redirect()->route('post.create')->with('message','レシピを投稿しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // レシピの詳細を表示＆いいね情報取得
    public function show(Post $post)
    {
        $nice=Nice::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        return view('post.show',compact('post','nice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // 変種画面に遷移（投稿ユーザーのみ）
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // 投稿内容編集（投稿ユーザーのみ）
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $inputs=$request->validate([
            'title'=>'required|max:20',
            'image'=>'required|image|max:1024',
            'food1'=>'required|max:10',
            'food2'=>'max:10',
            'food3'=>'max:10',
            'food4'=>'max:10',
            'food5'=>'max:10',
            'food6'=>'max:10',
            'food7'=>'max:10',
            'food8'=>'max:10',
            'food9'=>'max:10',
            'step1'=>'required|max:150',
            'step2'=>'max:150',
            'step3'=>'max:150',
            'step4'=>'max:150',
            'step5'=>'max:150',
        ]);

        $post->title = $request->title;
        $post->user_id = auth()->user()->id;
        $post->food1 = $request->food1;
        $post->food2 = $request->food2;
        $post->food3 = $request->food3;
        $post->food4 = $request->food4;
        $post->food5 = $request->food5;
        $post->food6 = $request->food6;
        $post->food7 = $request->food7;
        $post->food8 = $request->food8;
        $post->food9 = $request->food9;
        $post->step1 = $request->step1;
        $post->step2 = $request->step2;
        $post->step3 = $request->step3;
        $post->step4 = $request->step4;
        $post->step5 = $request->step5;
        $original = request()->file('image')->getClientOriginalName();
        $name = date('Ymd_His').'_'.$original;
        request()->file('image')->move('storage/images',$name);
        $post->image = $name;
        $post->save();
        return redirect()->route('post.show',$post)->with('message','レシピを編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // 投稿内容削除（投稿ゆーさーのみ）
    public function destroy(Post $post)
    {
      $this->authorize('delete', $post);
      $post->delete();
      return redirect()->route('post.index')->with('message','レシピを削除しました');  
    }

    //新着メニュー表示用の処理 
    public function newmenu(){
        $posts=Post::orderBy('created_at','desc')->get();
        return view('post.newmenu',compact('posts'));
    }
    //自己投稿メニュー表示用の処理 
    public function mymenu(){
        $user_id = Auth::id();
        $posts=Post::where('user_id', $user_id)->orderBy('created_at','desc')->get();
        return view('post.mymenu',compact('posts'));
    }

    //人気メニュー表示用の処理 
    public function nicemenu(){
        $posts = Post::withCount('nices')
        ->having('nices_count', '>', 0)
        ->orderBy('nices_count', 'desc')->take(4)->get();;
        return view('post.nicemenu',compact('posts'));
    }

    //自分の保存メニュー表示用の処理 
    public function mynicemenu(){
        $user_id = Auth::id();
        $posts = Nice::where('user_id', $user_id)
        ->orderBy('created_at','desc')
        ->select('id', 'post->image')
        ->get();
        $posts->load('post');

        return view('post.mynicemenu',compact('posts'));
    }

}
