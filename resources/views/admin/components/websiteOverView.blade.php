<div class="panel panel-default">

    <div class="panel-heading main-color-bg">
      <h3 class="panel-title">Website Overview</h3>
    </div>
    <div class="panel-body">
            <div class="col-md-3">
              <div class="well dash-box">
                <h2><i class="fa-solid fa-user"></i> {{ $num_users }}</h2>
                <h4>Users</h4>
              </div>
            </div>
            <div class="col-md-3 dash-box">
              <div class="well">
                <h2><i class="fa-solid fa-newspaper"></i> {{ $num_posts }}</h2>
                <h4>Posts</h4>
              </div>
            </div>
            <div class="col-md-3 dash-box">
              <div class="well">
                <h2><i class="fa-solid fa-bell"></i> {{ $num_notifications }}</h2>
                <h4>Notifications</h4>
              </div>
            </div>
    </div>
  </div>