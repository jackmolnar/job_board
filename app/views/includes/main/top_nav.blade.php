<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          {{--{{ link_to_action('UsersController@index', 'Job Board', null, ['class' => 'navbar-brand']); }}--}}
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>{{ link_to_action('AuthController@getLogout', 'Log Out', null, []); }}</li>
          </ul>
          <form class="navbar-form navbar-right">
            {{--<input type="text" class="form-control" placeholder="Search...">--}}
          </form>
        </div>
      </div>
    </div>