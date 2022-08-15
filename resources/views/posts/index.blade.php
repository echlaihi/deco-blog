@extends('layouts.app')

@section('content')

@if ( count($posts) )

        @foreach ($posts as $post )

        <article id="post" class="main-left-content">

            
            @if ( $post->img ) 
            <img class="img"/ src="{{ asset('storage/' . $post->img) }}">
            @endif

            <p class="post-category meta-data">News</p>
            <h5 class="post-title">{{ $post->title }}</h5>
            <div class="">
                <span class="post-author meta-data">{{ $post->user ? $post->user->name : '' }}</span>
                <span class="date meta-data">{{ $post->created_at->diffForHumans() }}</span>
            </div>


            <div class="post-body">
                {{ $post->getExerpt() }}
            </div>
            <a class="read-more" href="{{ route('post.show', $post->id) }}">Read more</a>
        </article>
            
        @endforeach

@else 

@endif
    
@endsection