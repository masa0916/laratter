<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tweet extends Model
{
    /** @use HasFactory<\Database\Factories\TweetFactory> */
    use HasFactory; 
    
    protected $fillable = ['tweet','retweet_id'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }  
  public function comments()
  {
    return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
  }
  public function liked()
  {
   return $this->belongsToMany(User::class)->withTimestamps();
  }
 public function tags()
{
    return $this->belongsToMany(Tag::class, 'tag_tweet');
}
public function originalTweet()
{
    return $this->belongsTo(Tweet::class, 'retweet_id');
}
public function retweets()
{
    return $this->hasMany(Tweet::class, 'retweet_id');
  
}
/**
     * このツイートを、指定されたユーザー（またはログインユーザー）がリツイート済みかを返す
     *
     * @param \App\Models\User|null $user
     * @return bool
     */
    public function isRetweetedBy($user = null)
    {
        $user = $user ?: Auth::user();

        if (! $user) {
            return false;
        }

        return $user->tweets()->where('retweet_id', $this->id)->exists();
    }
}

