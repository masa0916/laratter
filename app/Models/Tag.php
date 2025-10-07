<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory; 
     // ここに $fillable を追加
    protected $fillable = ['name'];

public function tweets()
{
    return $this->belongsToMany(Tweet::class, 'tag_tweet');

}  // ✅ このメソッドを追加してください！
    public function getRouteKeyName()
    {
        return 'name';
    }

}
