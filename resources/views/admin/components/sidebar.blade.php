<div class="list-group" id="sidebar">
  <a href="{{ route('dashboard') }}" id="dashboard" class="list-group-item">
    <i class="fa-solid fa-gear"></i><span class="element" id="dashboard"> Dashboard
  </span><a>
  <a href="{{ route('dashboard.posts') }}" id="posts" class="list-group-item">
    <i class="fa-solid fa-newspaper"></i><span class="element" id="posts"> Posts</span> <span class="badge">{{ $num_posts }}</span>
  </a>
  <a href="{{ route('dashboard.users') }}" id="users" class="list-group-item">
    <i class="fa-solid fa-user"></i><span class="element" id="users"> Users</span> <span class="badge">{{ $num_users }}</span>
  </a>

  <a href="{{ route('notifications.list') }}" id="notifications" class="list-group-item">
    <i class="fa-solid fa-bell"></i><span class="element" id="notifications"> Notifications</span> <span class="badge">{{ $num_notifications }}</span>
  </a>

  
  
  <a id="edit-profile" href="{{ route('user.edit-profile') }}" class="list-group-item"><i class="fa-solid fa-bell"></i><span class="element" id="edit-profile"> Edit profile - password</span></a>

  <form method="POST" class="list-group-item" action="{{ route('user.delete', auth()->user()->id) }}">
    @csrf
    @method('DELETE')
    <div  style="cursor: pointer;" onclick="(function(){
      
      var form = event.target.parentElement;
      if (confirm('Do you really want to delete your account ?')) {
        form.submit();
      }
    })();"><i class="fa-solid fa-circle-minus"></i> Delete account</div>
  </form>

  <form action="{{ route('logout') }}" method="POST" class="list-group-item" id="logoutForm">
     @csrf
     <div onclick="(function(){
      var form = document.querySelector('#logoutForm');
      if(confirm('Do you really want to logout')) {
        form.submit();
      }
     })();" style="cursor: pointer;"><i class="fa-solid fa-arrow-right-from-bracket"></i> logout</div>
  </form>

</div>