@extends('admin.layout')

@section('table')
<div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><b>Users:</b> </h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <tr>
          <th>Name: </th>
          <th>Email: </th>
          <th>Is admin?: </th>
          <th>Joined: </th>
          <th>Options: </th>
        </tr>

        @foreach ($users as $user )

            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><b>{{ $user->is_admin ? "YES" : "NO" }}</b></td>
                <td>{{ $user->created_at->diffForHumans() }}</td>

                <td class="d-flex">

                      <form method="post" class="mx-4" action="{{ route('user.delete', $user->id) }}">
                        @csrf
                        @method("DELETE")

                        <input type="button" value="delete" class="delete btn btn-danger btn-sm" />
                      </form>

                </td>
            </tr>
                
        @endforeach

        <script>
          var deletes = document.getElementsByClassName('delete');
          Array.from(deletes).forEach(function ( delete ) {
            delete.addEventListener('click', function (e) {
                var form = e.target.parentElement;

                if (confirm("Do you really want to delete that user ?")) {
                  form.submit();
                }
            });
          });
        </script>
        
    </table>
    {{ $users->links() }}
</div>
</div>

@endsection