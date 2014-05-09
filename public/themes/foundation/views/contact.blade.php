@extends(Theme::getLayoutPath().'default')
@section('title', 'Contact')
@section('meta-description', Cache::get('description'))
@section('content')
<div class="row block">
    <div class="large-12 columns">
        <span class="text-danger">Note: All fields are required.</span>
        <br /><br />
        {{Form::open(['method' => 'POST', 'action' => 'HomeController@postContact','class' => 'form', 'role' => 'form'])}}
        <div class="row">
            <div class="large-4 columns">
                {{Form::text('name',null,['class' => 'form-control','placeholder' => 'Name'])}}
            </div>
        </div>
        <div class="row">
            <div class="large-4 columns">
                {{Form::text('email',null, ['class' => 'form-control', 'placeholder' => 'Email'])}}
            </div>
        </div>
        <div class="row">
            <div class="large-8 columns">
                {{Form::textarea('content',null,['rows' => '15','class' => 'form-control','placeholder' => 'Message'])}}
            </div>
        </div>
        {{Form::submit('Send Message', ['class' => 'button'])}}
        {{Form::close()}}
    </div>
</div>
@stop
