@if($authed_user->role->title == 'Administrator')
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li>{{ link_to_action('UsersController@index', 'Dashboard', null, []); }}</li>
        <li>{{ link_to_action('UsersController@index', 'Messages', null, []); }}</li></li>
        <li>{{ link_to_action('JobsController@index', 'Manage Jobs', null, ['name'=>'Manage Jobs']); }}</li>
        <li>{{ link_to_action('UsersController@index', 'Manage Graduates', null, []); }}</li>
        <li>{{ link_to_action('UsersController@edit', 'Edit Profile', $authed_user->id, []); }}</li>
      </ul>
    </div>
@elseif($authed_user->role->title == 'Graduate')
     <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li>{{ link_to_action('UsersController@index', 'Dashboard', null, []); }}</li>
        <li>{{ link_to_action('UsersController@index', 'Messages', null, []); }}</li></li>
        <li>{{ link_to_action('JobsController@all', 'View Jobs', null, ['name'=>'Manage Jobs']); }}</li>
        <li>{{ link_to_action('UsersController@edit', 'Edit Profile', $authed_user->id, []); }}</li>
      </ul>
    </div>
@endif

