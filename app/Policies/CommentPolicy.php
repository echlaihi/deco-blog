<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Comment;

use function PHPUnit\Framework\isEmpty;

class CommentPolicy
{
    use HandlesAuthorization;

   public function canManage(User $user, Comment $comment)
   {
       if (auth()->check()){
           return $user->id == $comment->user_id;
       } 

       return false;
   }

}
