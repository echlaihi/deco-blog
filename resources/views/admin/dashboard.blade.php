@extends('admin.layout')

@section('table')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><b>Latest Users ( Have joined Us this week ):</b></h3>
  </div>
  <div class="panel-body">
    
        @if ( count($new_users) )

          <table class="table table-striped table-hover">
            <tr>
              <th>Name: </th>
              <th>Email: </th>
              <th>Is admin?: </th>
              <th>Joined: </th>
            </tr>
      
            @foreach ( $new_users as $new_user )
            
                <tr>
                  <td>{{ $new_user->name }}</td>
                  <td>{{ $new_user->email }}</td>
                  <td><b>{{ $new_user->is_admin ? "YES" : "NO" }}</b></td>
                  <td>{{ $new_user->created_at->diffForHumans() }}</td>
                </tr>
                      
              @endforeach
      
            </table>
            {{ $new_users->links() }}
          
        @else

            <div class="alert alert-info">No user have joined this week.</div>

        @endif

    </div>
</div>

  @endsection
