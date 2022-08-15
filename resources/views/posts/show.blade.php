@extends('layouts.app')

@section('content')

<article>

    {{-- <div class="">
        <div class="btn btn-sm btn-danger"><a href="{{ route('post.edit', $post->id) }}">edit</a></div>
    </div> --}}

    @if ($post->img)
        <img class="img" src="{{ asset('storage') . '/' . $post->img }}">    
    @endif
    <p class="post-category meta-data">{{ $post->category ? $post->category->name : '' }}</p>
    <h5 class="post-title">{{ $post->title }}</h5>
    <div class="meta-data-block">
        <span class="post-author meta-data">{{ $post->user->name }}</span>
        <span class="date meta-data">{{ $post->created_at->diffForHumans() }}</span>
    </div>


    <div class="post-body">
        {{ $post->body }}
    </div>


    <!-- <p class="tags meta-data">beautiful, nature, weather</p> -->

    <!-- <div class="footer-post">
        <span class="comments"></span>
        <span class="likes"></span>
        <span class="rating">averge</span>
        <div class="social-media"></div>
    </div> -->




</article>


<div class="other-posts">
    <div id="prev" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url('{{ asset('storage') . '/' . $recommended_posts->first()->img }}') !important; background-size: cover; background-repeat: no-repeat; "><span><a href="{{ route('post.show', $recommended_posts->first()->id) }}"></a>previous post</span></div>
    <div id="next" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url('{{ asset('storage') . '/' . $recommended_posts->last()->img }}') !important; background-size: cover; background-repeat: no-repeat; "><span><a href="{{ route('post.show', $recommended_posts->last()->id) }}">next</a></span></div>
</div>

<!-- <div class="author">
    <div class=""
</div> -->

<div class="recommended-posts">
    <div class="heading">
        <h1>Recommended posts</h1>
    </div>

    <div class="posts-block">


        @if($recommended_posts->count()) 
{{--  --}}


        @foreach($recommended_posts as $r_post)
            <div class="recommended-post-card">
                <img class="recommended-post-img" src="{{ asset('storage') . '/' . $r_post->img }}">
                <h5 class="title"><a href="{{ route('post.show', $r_post->id) }}">{{ $r_post->title }}</a></h5>
            </div>
        @endforeach

         @endif


    </div>
</div>
    
@endsection