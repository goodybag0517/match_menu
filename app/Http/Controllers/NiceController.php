<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Nice;
use Illuminate\Support\Facades\Auth;

class NiceController extends Controller
{
        // 保存情報をDBに記録
    public function nice(Post $post, Request $request){
        $nice=New Nice();
        $nice->post_id=$post->id;
        $nice->user_id=Auth::user()->id;
        $nice->save();
        return back();
    }

    // 保存情報をDBから消去
    public function unnice(Post $post, Request $request){
        $user=Auth::user()->id;
        $nice=Nice::where('post_id', $post->id)->where('user_id', $user)->first();
        $nice->delete();
        return back();
    }

}
