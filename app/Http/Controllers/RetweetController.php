<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetweetController extends Controller
{
    public function store(Tweet $tweet)
    {
        $user = Auth::user();

        // すでにリツイート済みなら何もしない（重複防止）
        if ($user->tweets()->where('retweet_id', $tweet->id)->exists()) {
            return back()->with('message', 'すでにリツイートしています');
        }

        // 新しくリツイートを作成
        $user->tweets()->create([
            'tweet' => $tweet->tweet,  // 元のツイートの本文をコピー
            'retweet_id' => $tweet->id,
        ]);

        return back()->with('message', 'リツイートしました');
    }
}
