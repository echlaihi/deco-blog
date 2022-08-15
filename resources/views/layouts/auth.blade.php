<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title></title>
    <style>
        header {
                    height: 3.2rem;
        }


        body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .wrapper{
           height: fit-content;
           display: flex;
           justify-content: center;
        }

        .left-content{
            margin-top: 2rem;
        }

   
    </style>
</head>

<body>



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
    </header>

      @include('includes.nav')

    <main>
        <div class="wrapper">
            @yield('content')
        </div>


    </main>

    <footer>
        <div id="lower-footer">
            <p>&copy; 2015 copyright .all right reserved by awesome theme | terms of policy | disclamer.</p>
        </div>
    </footer>
    <script src="{{ asset('/js/app.js') }}"></script>

    <script>
        var toggler = document.getElementById('toggler-icon');
        var nav = document.getElementById('nav');

        toggler.addEventListener('click', function() {
            nav.classList.toggle('active');
        });

    </script>

</body>

</html>