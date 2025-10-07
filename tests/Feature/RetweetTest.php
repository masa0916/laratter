<?php


use App\Models\User;
use App\Models\Tweet;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// 不要なら削除してOK
// it('has retweet page', function () {
//     $response = $this->get('/retweet');
//     $response->assertStatus(200);
// });

it('allows a user to retweet a tweet', function () {
    $user = User::factory()->create();
    $originalTweet = Tweet::factory()->create();

    $this->actingAs($user)
         ->post(route('tweets.retweet', $originalTweet))
         ->assertRedirect();

    $this->assertDatabaseHas('tweets', [
        'retweet_id' => $originalTweet->id,
        'user_id' => $user->id,
    ]);
});
