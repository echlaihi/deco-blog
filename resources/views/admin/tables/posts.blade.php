@extends('admin.layout')

@section('table')
<div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><b>Posts:</b> </h3>
    </div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <tr>
          <th>Title:</th>
          <th>Author:</th>
          <th>Created at: </th>
          <th>Options: </th>
        </tr>

        @foreach ($posts as $post )

            <tr>
                <td>{{ $post->titleExcerpt() }}</td>
                <td>autheur</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
                <td class="d-flex">

                    <a class="btn btn-sm btn-default" href="{{ route('post.show', $post->id) }}">Read</a>

                    <a class="btn btn-sm btn-info" href="{{ route('post.edit', $post->id) }}">Edit</a>

                   <form style="display: inline;" method="post" action="{{ route('post.destory', $post->id) }}">
                    @method("DELETE")
                    @csrf
                    <input type="button" value="Delete"  class="btn btn-sm btn-danger delete">

                  </form>
                  

                </td>

            </tr>
                
        @endforeach
        
    </table>
            {{ $posts->links() }}
</div>
</div>

<script>
  var btns = document.querySelectorAll('.delete');

   Array.from(btns).forEach((btn) => {

     btn.addEventListener('click', function (e) {
      
        if (confirm("Do you really want to delete that post?")) {
          e.target.parentElement.submit();
        }

     });

   });
</script>
@endsection

