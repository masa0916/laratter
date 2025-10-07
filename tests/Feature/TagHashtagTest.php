<?php

use App\Models\Tweet;
use App\Models\Tag;
use App\Models\User;   // ← ここに追加
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can attach tags to a tweet', function () {
    // 1. タグを3つ作成
    $tags = Tag::factory()->count(3)->create();

    // 2. ツイートを作成
    $tweet = Tweet::factory()->create();

    // 3. タグをツイートに紐づけ
    $tweet->tags()->attach($tags->pluck('id'));

    // 4. ここで再読み込みして最新のタグを取得
    $tweet->load('tags');
    
    // 5. アサーション：タグが3つ紐づいている
    expect($tweet->tags)->toHaveCount(3);
});

it('shows tags on tweet detail page', function () {
      // ここにログインユーザーを作成＆ログイン処理を入れる
    $user = User::factory()->create();
    $this->actingAs($user);

    $tags = Tag::factory()->count(2)->create();
    $tweet = Tweet::factory()->create();

    $tweet->tags()->attach($tags->pluck('id'));

    $tweet->refresh(); // または $tweet->load('tags');

    $response = $this->get(route('tweets.show', $tweet));

     file_put_contents(__DIR__ . '/html-dump.html', $response->getContent());

    // 2つのタグ名がページ内に表示されていることを確認
    foreach ($tags as $tag) {
        $response->assertSee('#' . $tag->name);
  }
});
