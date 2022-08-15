<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </head>
    
 
    <body>
        <style>
            header {
                margin-bottom: 286px;
            }
        </style>
    
    
        <header>
            <div class="wrapper">
    
                <div id="toggler-icon">
                    <div id="inner-line"></div>
                </div>
    
                <div class="logo-container">
                    <div class="logo">D<span id="top"><span></span></span><span>co</div><span id="blog">Blog</span>
                    </div>
                    <div class="social-media">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
    
                </div>
            </div>
        </header>
    

    @include('includes.nav')
    
   
        <section id="banner">
    
            <div class="wrapper">
    
              <div class="carousel-container">
                @foreach($latest_posts as $l_post)
                <div class="carousel" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('storage') . '/'. $l_post->img }}'); background-repeat: no-repeat; background-size: cover;">
                    
                    <div id="heading">
                        <h3>Latest News</h3>
                        <h2>{{ $l_post->title }}</h2>
                    </div>

                </div>
             @endforeach
              </div>

               <div id="navigation-zone">

                        <div id="boxes">
                            <div class="box" id="0"></div>
                            <div class="box active" id="1"></div>
                            <div class="box" id="2"></div>
                        </div>

                </div>  
            </div>
    
        </section>
    
    <main>

        <div class="wrapper">

            <div class="left-content">

                @yield('content')

            </div>

            <aside>
                <form action="{{ route('post.search') }}" id="search-form" method="GET">
                    <input type="text" placeholder="search" name="search">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>

                <img src="images/Layer 93.jpg" alt="">

                <h3>Categories</h3>
                @if(count($categories))
                <ul>
                    @foreach ($categories as $c)
                    <li><a href="">{{ $c['name'] }}</a><span class="category_number">{{ $c['posts'] }}</span></li>
                    @endforeach
                </ul>
                @else
{{-- if no category --}}
                @endif


                <div class="ads"></div>

                <h3>latest posts</h3>

                @if(count($latest_posts))

                    @foreach($latest_posts as $latest_post)

                        <div class="post-block">
                            @if ($latest_post->img)
                                <img src="{{ asset('storage') . '/'. $latest_post->img }}" alt="" class="img">
                            @endif
                            <div class="inner-post-block">
                                <h5 class="title"><a href="{{ route('post.show', $latest_post->id) }}">{{ $latest_post->title }}</a></h5>
                            <span class="date">{{ $latest_post->created_at->diffForHumans() }}</span>
                            <span class="">By : {{ $latest_post->user ? $latest_post->user->name : '' }}</span>

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

        </div>

    </main>

    <!-- footer -->
<script>
        var toggler = document.getElementById('toggler-icon');
        var nav = document.getElementById('nav');

        toggler.addEventListener('click', function() {
            nav.classList.toggle('active');
        });

       $(document).ready(function(){
            $(window).scroll(function (){
               var scrollHeight = $(window).scrollTop();
               if (scrollHeight > 648) {
                $('header').css({
                    width: '100%',
                    height: '3.2rem',
                });
               } else {
                $('header').css({
                    height: '21.0625rem',
                });
               }
            });


            // carousel
           var boxes = Array.from($('#boxes > .box'));
            var carousels = Array.from($('.carousel'));
            boxes.forEach( box => {
                $(box).click(function (){
                    var a = parseInt($(box).attr('id'));
                   carousels.forEach(function(carousel) {
                        $(carousel).css({'opacity': '0'});
                    });

                    $(carousels[a]).css({'opacity': '1'});

                    boxes.forEach(bx => {
                        $(bx).removeClass('active');
                    })

                    $(box).addClass('active');

                });
            });
       });
       
    </script>

    <footer>
        <div class="wrapper">

            <div class="col" id="">
                <h3>about the blog</h3>
                <p>Lorem ipsum dolor sit, amet contur asicing elit. Bitiis, minus!</p>
                <div name="" id="signature">
                    <p>Nathalie John</p>
                </div>
            </div>

            <div class="col">
                <h3>Latest tweets</h3>

                <div class="tweets">

                    <div class="tweet">
                        <span class="email">twitter@user.com</span>
                        <p class="tweet">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore, sed?</p>
                    </div>

                    <div class="tweet">
                        <span class="email">twitter@magicaluser.com</span>
                        <p class="tweet">nam quo laborum cupiditate fuga dolore. Nisi quidem dicta consequatur.</p>
                    </div>

                </div>

            </div>

            <div class="col">
                <h3>follow me on instragram</h3>
                <div class="images">
                    <div class="img"></div>
                    <div class="img"></div>
                    <div class="img"></div>
                    <div class="img"></div>
                    <div class="img"></div>
                    <div class="img"></div>
                </div>
            </div>

            <div class="col">
                <h3>latest comments</h3>

                <div class="comment-box">
                    <span class="commentor">From alex: </span>
                    <p class="comment">Lorem ipsum dolor, sit adipisicing elit. Et deleniti sunt! Lorem, ipsum.</p>
                </div>

                <div class="comment-box">
                    <span class="commentor">From jhon doe: </span>
                    <p class="comment">adipisicing elit. Illum rerum labore corrupti corporis Lorem, ipsum.</p>
                </div>
            </div>
        </div>

        <div id="lower-footer">
            <p>&copy; 2015 copyright .all right reserved by awesome theme | terms of policy | disclamer.</p>
        </div>

    </footer>

    </body>
</html>
