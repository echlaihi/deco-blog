<nav id="nav">
    <ul>
        <li>
          
           @if (auth()->check())
           <a href="{{ route('dashboard') }}">Dashboard</a>
           <li><a onclick="if ( confirm('do you really want to logout? ')  ){
               document.getElementById('logoutForm').submit(); 
           };">Logout<form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf

            </form></a></li>
           @else
           <li><a href="{{ route('login') }}">Login</a></li>
           <li><a href="{{ route('register') }}">Register</a></li>
           @endif
                
        </li>
        <li><a href="{{ route('post.index') }}">Home</a></li>
        <li><a href="about.html">About Us</a></li>
        <li><a href="contact.html">Contact Us</a></li>
    </ul>
</nav>