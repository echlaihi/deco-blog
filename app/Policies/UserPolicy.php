<?php
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Http\Request;

class UserPolicy
{
    use HandlesAuthorization;

   public function delete(User $auth, $user)
   {
        return ( $auth->is_admin and !$user->is_admin ) or ( $auth->id == $user->id );
   }

}
