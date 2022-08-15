<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;
use Illuminate\Support\Facades\Storage;
use App\Notifications\PostCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function list()
    {
        $posts = Post::paginate(10);
        $num_users = User::all()->count();
        $num_posts = Post::all()->count();
        $num_notifications = count(auth()->user()->unreadNotifications);
        return view('admin.tables.posts')->with([
            'num_notifications' => $num_notifications,
            'posts'             => $posts,
            'num_users'         => $num_users,
            'num_posts'         => $num_posts]);

    }
    /**
     * Display a listing of the post.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $id = isset($id) ? (int) $id : 0;

       $posts = ($id != 0) ? Post::where('category_id', $id)->paginate(10) : Post::paginate(10);

        return view('posts.index',[
            'posts'        => $posts,
            'categories'   => $this->getCategories(),
            'latest_posts' => $this->getLatestPosts(),

        ] );

      
    }

    /**
     * Show the form for creating a new post.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $num_posts = Post::where('user_id', auth()->user()->id)->get()->count();
        return view('posts.create', [
            'num_posts'    => $num_posts,
            'categories'   => $this->getCategories(),
            'latest_posts' => $this->getLatestPosts(),
        ]);

    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\PostFormRequest  $PostFormRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $postFormRequest)
    {
        

        if ($postFormRequest->hasFile('img')){

            $file = $postFormRequest->file('img');
            Storage::put('public',$file);

            $img = $postFormRequest->file('img')->hashName();
        }


        $post = Post::create([
            "title"       => $postFormRequest->input("title"),
            "body"        => $postFormRequest->input("body"),
            "img"         => isset($img) ? $img : null,
            "user_id"     => auth()->user()->id,
            "category_id" => $postFormRequest->input("category_id"),
        ]);

        // notify the admin
        $admins = User::where("is_admin", 1)->get();

        foreach ( $admins as $admin ){
            $admin->notify(new PostCreatedNotification($post));
        }

        return redirect(route('dashboard'));

    }

    /**
     * Display the specified post.
     *
     * @param  \App\Models\Post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'categories'        => $this->getCategories(),
            'latest_posts'      => $this->getLatestPosts(),
            'post'              => $post,
            'recommended_posts' => Post::where('category_id', $post->category_id)->get()->take(3),
        ]);
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  \App\Models\Post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $this->authorize('manage', $post);
        return view('posts.edit', [
            'num_posts'     => Post::where('user_id', auth()->user()->id)->get()->count(),
            'post'          => $post,
            'latest_posts'  => $this->getLatestPosts(),
            'categories'    => $this->getCategories(),
        ]);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\PostFormRequest  $postFormRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $postFormRequest, Post $post)
    {
        $this->authorize('manage', $post);

        if ($postFormRequest->hasFile("img")){

            // update the file
            $image      = $postFormRequest->file("img");
            Storage::put('public', $image);
            $last_image = $post->img;
            Storage::delete($last_image);
            $image      = $image->hashName();

            $post->update([
                'img' => $image,
            ]);
        }

        $post->update([
            'title' => $postFormRequest->input("title"),
            'body'  => $postFormRequest->input("body"),
        ]);
        return redirect(route("post.show", $post->id));  

    }

    /**
     * Remove the specified post from storage.
     *
     * @param  \App\Models\Post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('manage', $post);
        $post->delete();

        return back();
    }


    /**
     * return a posts matches a query 
     * @param string
     * @param \Illuminate\http\Request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        return view('posts.search')->with([
            'posts'        => Post::query()->where("title","LIKE" ,"%{$search}%")->get(),
            'categories'   => $this->getCategories(),
            'latest_posts' => $this->getLatestPosts(),
            'search'       => $search,
        ]);
    }

    private function getCategories()
    {
        $categories = Category::all();

        $i=0;
        foreach($categories as $c)
        {
            $newCategories[$i]['id']    = $c['id'];
            $newCategories[$i]['name']  = $c['name'];
            $newCategories[$i]['posts'] = $c->post->count();
            $i++;
        }

        return $newCategories;


    }

    


}
