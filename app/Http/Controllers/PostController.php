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

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $posts=Post::orderBy('created_at','desc')->take(4)->get();
        $user_id = Auth::id();
        $MyPosts=Post::where('user_id', $user_id)->orderBy('created_at','desc')->take(4)->get();
        $NicePosts = Post::withCount('nices')->orderBy('nices_count', 'desc')->take(4)->get();;
        return view('post.index',compact('posts','MyPosts','NicePosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request)
    {
        $inputs=$request->validate([
            'title'=>'required|max:255',
            'image'=>'required|image|max:1024',
            'food1'=>'required|max:255',
            'food2'=>'max:255',
            'food3'=>'max:255',
            'food4'=>'max:255',
            'food5'=>'max:255',
            'food6'=>'max:255',
            'food7'=>'max:255',
            'food8'=>'max:255',
            'food9'=>'max:255',
            'step1'=>'required|max:1000',
            'step2'=>'max:1000',
            'step3'=>'max:1000',
            'step4'=>'max:1000',
            'step5'=>'max:1000',
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
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $inputs=$request->validate([
            'title'=>'required|max:255',
            'image'=>'required|image|max:1024',
            'food1'=>'required|max:255',
            'food2'=>'max:255',
            'food3'=>'max:255',
            'food4'=>'max:255',
            'food5'=>'max:255',
            'food6'=>'max:255',
            'food7'=>'max:255',
            'food8'=>'max:255',
            'food9'=>'max:255',
            'step1'=>'required|max:1000',
            'step2'=>'max:1000',
            'step3'=>'max:1000',
            'step4'=>'max:1000',
            'step5'=>'max:1000',
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
        $posts = Post::withCount('nices')->orderBy('nices_count', 'desc')->take(4)->get();;
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
