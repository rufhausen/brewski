@extends('Admin::layouts.master')
@section('title', 'Site Options')
@section('content')
{{Form::open(['role' => 'form', 'method' => 'PUT','action' => ['Brewski\Controllers\Admin\OptionsController@putUpdate']])}}
<div class="row">
    <div class="col-md-6 form-group">
        {{Form::label('site_name','Site Name')}}
        {{Form::text('site_name', $options->site_name, ['class' => 'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="col-md-4 form-group">
        {{Form::label('admin_email','Admin Email')}}
        {{Form::text('admin_email', $options->admin_email, ['class' => 'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="col-md-2 form-group">
        {{Form::label('posts_per_page')}}
        {{Form::select(
        'posts_per_page',
        ['1' => 1, '5' => 5, '10' => 10],
        $options->posts_per_page,
        ['style' => 'width: 50px;','class' => 'form-control']
        )}}
    </div>
</div>
<div class="row">
    <div class="col-md-12 form-group">
        {{Form::label('keywords','Meta Keywords')}}
        {{Form::text('keywords', $options->keywords, ['class' => 'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="col-md-12 form-group">
        {{Form::label('description','Meta Description')}}
        {{Form::textarea('description', $options->description, ['class' => 'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="col-md-5 form-group">
        {{Form::label('theme','Theme')}}
        {{Form::select('theme',$themes,$options->theme, ['class' => 'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="col-md-3 form-group">
        {{Form::label('cache_time','Cache Time (in seconds)')}}
        {{Form::text('cache_time', $options->cache_time, ['class' => 'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="col-md-3 form-group">
        {{Form::label('google_analytics_id','Google Analytic ID')}}
        {{Form::text('google_analytics_id', $options->google_analytics_id, ['class' => 'form-control'])}}
    </div>
</div>
<div class="row">
    <div class="col-md-3 form-group">
        {{Form::label('disqus_shortname','Disqus Short Name')}}
        {{Form::text('disqus_shortname', $options->disqus_shortname, ['class' => 'form-control'])}}
    </div>
</div>
{{Form::submit('Update',['class' => 'btn btn-primary'])}}
@stop
