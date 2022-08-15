@extends('admin.layout')

@section('table')
<div class="panel panel-default">
    <div class="panel-heading">

            @if ($notifications->count())
            
            <h3 class="panel-title" style="display: flex !important; justify-content: space-around !important; align-items: center;"><b class=''>Notifications:</b> <a class="btn btn-danger mr-auto" href="{{ route('notification.readAll') }}">Mark all notifictions as read.</a></h3>

            @else

                <h3 class="panel-title"><b class=''>Notifications:</b></h3>
                
            @endif
        


    </div>

    <div class="panel-body">

                
                @if($notifications->count() == 0) 
                    <div class="alert alert-info">No notification</div>
                @else

                @foreach ($notifications as $notification )

                    <div class="alert alert-info d-flex justify-content-space-between">

                        
                        {{ $notification->data['title'] }}
                        
                        @if ($notification->type == 'App\Notifications\PostCreatedNotification')
                            <a  class="btn btn-info btn-sm" href="{{ route('post.show', $notification->data['post_id']) }}">Check notified</a>
                        @endif
                        <a class="btn btn-danger btn-sm" href="{{ route('notification.read', $notification->id) }}">Mark as read</a>

                    </div>

                        
                @endforeach
                
                </div>

            {{ $notifications->links() }}

            @endif
   </div>
</div>

@endsection