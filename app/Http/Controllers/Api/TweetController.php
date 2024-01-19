<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tweet;
use App\Http\Requests\TweetRequest;

class TweetController extends Controller
{
    function get() {
        $tweets = Tweet::with("user")
            ->orderBy("created_at","desc")
            ->limit(25)
            ->get();

        return response()->json($tweets);
    }

    function add(TweetRequest $request) {

        // 認証されているユーザーを取得
        $user = $request->user();

        // IDが一致していたら
        if($request->user_id == $user->id){
            // データベースに保存
            $tweet = Tweet::create($request->all());
            $tweet->user = $user;
            return response()->json($tweet);
        } else {
            // そうじゃないならエラーを吐く 
            return response()->json(
                ["error" => "invalid tweet"], 
                401
            );
        }
    }
}
