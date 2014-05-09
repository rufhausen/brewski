@extends(Theme::getLayoutPath().'default')
@section('title', 'Contact')
@section('meta-description', Cache::get('description'))
@section('content')
<div class="row block">
    <div class="col-md-12">
        <span class="text-danger">Note: All fields are required.</span>
        <br /><br />
        {{Form::open(['method' => 'POST', 'action' => 'HomeController@postContact','class' => 'form', 'role' => 'form'])}}
        <div class="row">
            <div class="form-group col-md-4">
                {{Form::text('name',null,['class' => 'form-control','placeholder' => 'Name'])}}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                {{Form::text('email',null, ['class' => 'form-control', 'placeholder' => 'Email'])}}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-8">
                {{Form::textarea('content',null,['rows' => '15','class' => 'form-control','placeholder' => 'Message'])}}
            </div>
        </div>
        @if(Cache::get('options')->recaptcha_enabled)
        <div class="row">
            <div class="form-group col-md-12">
                {{Form::captcha()}}
            </div>
        </div>
        @endif
        {{Form::submit('Send Message', ['class' => 'btn btn-primary'])}}
        {{Form::close()}}
    </div>
</div>
@stop
