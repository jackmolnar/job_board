        @if($user->role->title == 'Administrator')
            @include('../includes/jobs/edit_button')
            @include('../includes/jobs/delete_button')
        @elseif($user->role->title == 'Employment Specialist')
            @include('../includes/jobs/edit_button')
            @include('../includes/jobs/delete_button')
        @elseif($user->role->title == 'Graduate')
            @include('../includes/jobs/apply_button')
        @endif
