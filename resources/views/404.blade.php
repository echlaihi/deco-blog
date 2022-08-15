<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>Document</title>
</head>

<body>
    <main id="not-found-container">

        <section id="not-found-section">
            <div id="not-found-icon">

                <h1>404</h1>
                <p><span>Uh.Uh!</span><span>Nothing</span><span>found</span></p>


            </div>

            <form action="{{ route('post.search') }}" method="GET" id="not-found-search">
                <input type="text" name="search" id="" placeholder="Type any key word">
                <input type="submit" value="Search">
            </form>

            <h3>Sorry!</h3>
            <p class="p">The page you are looking for does not exists or an error occured</p>
            <a href="{{ route('post.index') }}">Go back home</a>
        </section>

    </main>


</body>

</html>