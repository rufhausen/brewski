{{Form::open(['method' => 'GET', 'action' => 'HomeController@search'])}}
{{Form::text('q',null,['placeholder' => 'Search','class' => 'form-control'])}}
{{Form::close()}}
