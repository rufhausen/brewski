{{Form::open(['method' => 'GET', 'action' => 'HomeController@search'])}}
{{Form::text('q',null,['placeholder' => 'Enter search term(s)','class' => 'form-control'])}}
{{Form::close()}}
