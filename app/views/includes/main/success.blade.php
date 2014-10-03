 @if(count(Session::get('success')) > 0 )
 	<div class="alert alert-success" role="alert">
 		<ul>
 				<li>{{ Session::get('success') }}</li>
 		</ul>
 	</div>
 @endif