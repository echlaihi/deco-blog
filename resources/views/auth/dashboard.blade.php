@extends('layouts.auth')

@section('content')

<div class="left-content">

   <section id="posts-container">

    @if (count($posts))

            @if (count($posts) > 4)

                    @for ($i=0,$k=0; $i < count($posts); $i++)
                    
                    <div class="posts-col">
                            @for ($j=0; $j < 4 && $k < count($posts); $j++, $k++)
                            <div class="post-card">
                                <div class="post-control"><a href="{{ route('post.edit', $posts[$i]->id) }}"><i class="fa-solid fa-pen"></i></a>
                                    <form action="{{ route('post.destory', $posts[$i]->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <div style="cursor: pointer;" onclick="(function(){
                                            var form = event.target.parentNode.parentNode;
                                            if ( confirm('Do you really want to delete that post?') ) {
                                                form.submit();
                                            }
                                        
                                    })();"><i class="fa-solid fa-trash-can"></i></div>
                                </form>
                                </div>
                                    
                                        @if($posts[$j]->img)
                                            <img class="img" src="{{ asset('storage') . '/' . $posts[$j]->img }}">
                                        @endif

                                    <div class="post-category">{{ $posts[$j]->category ? $posts[$j]->category->name : ""  }}</div>
                                    <h5 class="post-title">{{ $posts[$j]->title }}</h5>
                                    <small class="date">{{ $posts[$j]->created_at->diffForHumans() }}</small>
                                    <a href="{{ route('post.show', $posts[$j]->id) }}" class="read-more">read more</a>
                                    <div class="comments">
                                        <small>no comment</small>
                                        <div class="comment-icon"></div>
                                        <div class="social-media"></div>
                                    </div>
                             </div>
                            @endfor
                    </div>
                    @endfor

            @else

               @foreach ($posts as $post )
                    <div class="posts-col">
                        <div class="post-card">
                            <div class="post-control">
                                
                                <a href="{{ route('post.edit', $post->id) }}"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('post.destory', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div style="cursor: pointer;" onclick="(function(){
                                            var form = event.target.parentNode.parentNode;
                                            if ( confirm('Do you really want to delete that post?') ) {
                                                form.submit();
                                            }
                                        
                                    })();"><i class="fa-solid fa-trash-can"></i></div>
                                </form>
                            </div>
                            
                                @if($post->img)
                                    <img class="img" src="{{ asset('storage') . '/' . $post->img }}">
                                @endif

                            <div class="post-category">{{ $post->category ? $post->category->name : "" }}</div>
                            <h5 class="post-title">{{ $post->title }}</h5>
                            <small class="date">{{ $post->created_at->diffForHumans() }}</small>
                            <a href="{{ route('post.show', $post->id) }}" class="read-more">read more</a>
                            <div class="comments">
                                <small>no comment</small>
                                <div class="comment-icon"></div>
                                <div class="social-media"></div>
                            </div>
                        </div>
                    </div>    
               @endforeach

            @endif

    @else 

        <div class="alert alert-danger" style="width: 100%;">No post found</div>
    @endif

   </section>
   
</div>

@include('includes.authAside')
    
@endsection