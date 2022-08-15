<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Str;
use App\Models\User;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id', 'img', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getExerpt()
    {
        return Str::substr($this->body, 0,200) . " ...";
    }

    public function getExtraExerpt()
    {
        return Str::substr($this->body, 0,50) . " ...";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function titleExcerpt()
    {
        return Str::substr($this->title, 0, 10) . ' ...';
    }




    
    
}
