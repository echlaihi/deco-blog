<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        $num_users = User::all()->count();
        $num_posts = Post::all()->count();
        $num_notifications = count(auth()->user()->unreadNotifications);
        
        return view('admin.tables.users')->with([
           'num_notifications' => $num_notifications,
           'users' => $users,
           'num_users' => $num_users,
           'num_posts' => $num_posts
        ]);
    }

    public function delete(User $user ,Request $request)
    {
        $this->authorize('delete', $user);
        if ( auth()->user()->id == $user->id ) {
            
            Auth::logout();
            $user->delete();
            return redirect(route('login'));

        }

        $user->delete();
        return back();
       
    }

    public function edit_profile()
    {   
        $user = auth()->user();

        if ( auth()->user()->is_admin ) {

            $num_users = count(User::all());
            $num_posts = count(Post::all());
            $num_notifications = count(auth()->user()->unreadNotifications);


            return view('admin.edit-profile')->with([
                    'user'              => $user,
                    'num_posts'         => $num_posts,
                    'num_users'         => $num_users,
                    'num_notifications' => $num_notifications,
            ]);
        }

        return view('auth.edit-profile',[
            'user'      => $user,
            'num_posts' => Post::where('user_id', auth()->user()->id)->get()->count(),
            'latest_posts' => $this->getLatestPosts(),
        ]);

    }

    public function edit_password()
    {

        $user = auth()->user();

        if ( auth()->user()->is_admin ) {

            $num_users = count(User::all());
            $num_posts = count(Post::all());
            $num_notifications = count(auth()->user()->unreadNotifications);


            return view('user.edit-password')->with([
                    'user'              => $user,   
                    'num_posts'         => $num_posts,
                    'num_users'         => $num_users,
                    'num_notifications' => $num_notifications,
            ]);
        }

        return view('auth.edit-password')->with('user', $user);

    }

}
