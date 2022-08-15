<aside>
    <form action="{{ route('post.search') }}" method="GET" id="search-form">
        <input type="text" name="search" placeholder="search">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <img src="images/Layer 93.jpg" alt="">

    <h3>Dashboard</h3>
    <ul>
        <li><a href="">Your Posts</a><span class="category_number">{{ $num_posts }}</span></li>
        <li><a href="{{ route('post.create') }}">Create post</a></li>
        <li><a href="{{ route('user.edit-profile') }}">Edit profile - Change password</a></li>
        <li>
            <form action="{{ route('user.delete', auth()->user()->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div style="cursor: pointer;" onclick="(function(){
                    var form = event.target.parentElement;
                    if (confirm('Do you really want to delete your account ?')) {
                        form.submit();
                    }
                })();">Delete acount</div>
            </form>
        </li>
        <li><a onclick="if ( confirm('Do you really want to logout? ') ) {
            document.getElementById('logoutForm').submit();
        }">logout <form action="{{ route('logout') }}" method="POST">
            @csrf
        </form></a></li>
    </ul>


    <div class="ads"></div>

    <h3>latest posts</h3>
    

    @if(count($latest_posts))

        @foreach( $latest_posts as $latest_post )

            <div class="post-block">
                <img src="{{ asset('storage') . '/' . $latest_post->img }}" class="img"/>

                <div class="inner-post-block">

                    <h5 class="title"><a href="{{ route('post.show', $latest_post->id) }}">{{ $latest_post->title }}</a></h5>
                    <span class="date">{{ $latest_post->created_at->diffForHumans() }}</span>
                    <span class="">{{ $latest_post->user ? $latest_post->user->name : ''}}</span>

                </div>
            </div>

        @endforeach

    @endif

    <div class="social-media">

    </div>

    <div class="slider">
        <button></button>
        <button></button>
    </div>

    <div id="facebook"></div>

</aside>