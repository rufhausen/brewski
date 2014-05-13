@extends('admin.layouts.master')
@section('title', 'Site Options')
@section('content')
{{Form::open(['role' => 'form', 'method' => 'PUT','action' => ['OptionsController@putUpdate']])}}
<div class="row">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#basic" data-toggle="tab">Basic</a></li>
        <li><a href="#seo" data-toggle="tab">SEO</a></li>
        <li><a href="#social_media" data-toggle="tab">Social Media</a></li>
        <li><a href="#advanced" data-toggle="tab">Advanced</a></li>
    </ul>
</div>
<div class="tab-content" style="margin-top: 20px;">
    <div class="tab-pane active" id="basic">
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
            <div class="col-md-5 form-group">
                {{Form::label('theme','Theme')}}
                {{Form::select('theme',$themes,$options->theme, ['class' => 'form-control'])}}
            </div>
        </div>
    </div>
    <div class="tab-pane" id="seo">
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
            <div class="col-md-3 form-group">
                {{Form::label('google_analytics_id','Google Analytics ID')}}
                {{Form::text('google_analytics_id', $options->google_analytics_id, ['class' => 'form-control'])}}
            </div>
        </div>
    </div>
    <div class="tab-pane" id="social_media">
        <div class="row">
            <div class="col-md-3 form-group">
                {{Form::label('twitter_handle','Twitter Handle')}}
                {{Form::text('twitter_handle', $options->twitter_handle, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                {{Form::label('google_plus_url','Google Plus URL')}}
                {{Form::text('google_plus_url', $options->google_plus_url, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                {{Form::label('linked_in_url','LinkedIn URL')}}
                {{Form::text('linked_in_url', $options->linked_in_url, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                {{Form::label('facebook_url','Facebook URL')}}
                {{Form::text('facebook_url', $options->facebook_url, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                {{Form::label('rss_feed_url','RSS Feed URL')}}
                {{Form::text('rss_feed_url', $options->rss_feed_url, ['class' => 'form-control'])}}
            </div>
        </div>
    </div>
    <div class="tab-pane" id="advanced">
        <div class="row">
            <div class="col-md-12">
                {{Form::label('cache_time','Page Cache Timeout (in seconds)')}}
            </div>
            <div class="col-md-2 form-group">

                {{Form::text('cache_time', $options->cache_time, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="panel panel-danger">
            <div class="panel-heading">ReCaptcha</div>
            <div class="panel-body">
                <div class="form-group">
                    <label>
                        {{ Form::checkbox('recaptcha_enabled', '1', $options->recaptcha_enabled, ['id' =>
                        'recaptcha_enabled']) }}
                        Enable ReCaptcha
                    </label>
                </div>
                <div class="form-group">
                    {{Form::label('recaptcha_public_key','ReCaptcha Public Key')}}
                    {{Form::text('recaptcha_public_key', $options->recaptcha_public_key, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('recaptcha_private_key','ReCaptcha Private Key')}}
                    {{Form::text('recaptcha_private_key', $options->recaptcha_private_key, ['class' =>
                    'form-control'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                {{Form::label('disqus_shortname','Disqus Short Name')}}
                {{Form::text('disqus_shortname', $options->disqus_shortname, ['class' => 'form-control'])}}
            </div>
        </div>
    </div>
</div>

{{Form::submit('Update',['class' => 'btn btn-primary'])}}
@stop
