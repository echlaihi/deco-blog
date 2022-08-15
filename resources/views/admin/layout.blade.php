<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Area | Dashboard</title>
  {{-- <link href="{{ asset('css/bootstrap3.css') }}" rel="stylesheet"> --}}
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  <script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
</head>

<body>

  {{-- ====================================== the nav==================================================================== --}}
        @include('admin.components.nav')
  {{-- ===========end nav =============================================================================================== --}}

  {{-- === header ========================================================================================================= --}}
        @include('admin.components.header')
  {{-- === end header ===================================================================================================== --}}

  <section id="main">
    <div class="container">
      <div class="row">

        <div class="col-md-3">
          {{-- ====== sidebar ============================================================================================ --}}
                @include('admin.components.sidebar')
          {{-- === endsidebar ============================================================================================== --}}
        </div>

        <div class="col-md-9">
          {{-- --======= Website Overview ==================================================================================== --}}
                @include('admin.components.websiteOverView')
          {{-- == end website overview ======================================================================================= --}}
          

          {{-- ==== tables==================================================================================================== --}}
                @yield('table')
          {{-- === end tables ================================================================================================ --}}
          
         
        </div>
      </div>
    </div>
  </section>

  <footer id="footer">
    <p>Copyright AdminStrap &copy; 2021</p>
  </footer>

  
  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->

<script>
  var links = Array.from(document.querySelectorAll("#sidebar .element"));
  var element = window.location.href.split('/');
  
  if (element[element.length-1] == '') {
    element = element[element.length-2];
  } else {
    element = element.pop();
  }

  if( element.split('?').length != 1) {
    element = element.split('?')[0];
  };


// handling the sidebar
  for (let index = 0; index < links.length; index++) {
   
    if(links[index].id.trim().toLowerCase() == element ) {
       links[index].parentElement.classList.add('main-color-bg');
    };
  }

  // handling the navbar
  var sidebarlinks = Array.from(document.querySelectorAll('#navbar > ul > li > a'));
  for (let i = 0; i < sidebarlinks.length; i++) {
    
    if (sidebarlinks[i].innerHTML.toLowerCase().trim() == element) {
      sidebarlinks[i].parentElement.classList.add('active');
    }
    
  }
 </script>

 <!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>