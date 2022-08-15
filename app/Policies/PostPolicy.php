<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    public function manage(User $user, Post $post)
    {
      return ( $user->id == (int) $post->user_id ) or $user->is_admin;

    }
}
