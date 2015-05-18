@extends('admin.layouts.master')
@section('title', 'Site Options')
@section('content')
{!!Form::open(['role' => 'form', 'method' => 'PUT','action' => ['Admin\SettingsController@putUpdate']])!!}
<div class="row">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#basic" data-toggle="tab">Basic</a></li>
        <li><a href="#seo" data-toggle="tab">SEO</a></li>
        <li><a href="#social_media" data-toggle="tab">Social Media</a></li>
        <li><a href="#advanced" data-toggle="tab">Advanced</a></li>
        <li><a href="#email" data-toggle="tab">Email</a></li>
    </ul>
</div>
<div class="tab-content" style="margin-top: 20px;">
    <div class="tab-pane active" id="basic">
        <div class="row">
            <div class="col-md-6 form-group">
                {!!Form::label('site_name','Site Name')!!}
                {!!Form::text('site_name', $settings->site_name, ['class' => 'form-control'])!!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 form-group">
                {!!Form::label('tag_line','Tag Line')!!}
                {!!Form::text('tag_line', $settings->tag_line, ['class' => 'form-control'])!!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                {!!Form::label('admin_email','Admin Email')!!}
                {!!Form::text('admin_email', $settings->admin_email, ['class' => 'form-control'])!!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 form-group">
                {!!Form::label('posts_per_page')!!}
                {!!Form::select(
                    'posts_per_page',
                    ['1' => 1, '5' => 5, '10' => 10],
                    $settings->posts_per_page,
                    ['style' => 'width: 50px;','class' => 'form-control']
                    )!!}
                </div>
            </div>
        </div>
        <div class="tab-pane" id="seo">
            <div class="row">
                <div class="col-md-12 form-group">
                    {!!Form::label('meta_keywords','Meta Keywords')!!}
                    {!!Form::text('meta_keywords', $settings->meta_keywords, ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    {!!Form::label('meta_description','Meta Description')!!}
                    {!!Form::textarea('meta_description', $settings->meta_description, ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!!Form::label('google_analytics_id','Google Analytics ID')!!}
                    {!!Form::text('google_analytics_id', $settings->google_analytics_id, ['class' => 'form-control'])!!}
                </div>
            </div>
        </div>
        <div class="tab-pane" id="social_media">
            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="twitter_handle"><i class="fa fa-twitter"></i> Twitter Handle</label>
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        {!!Form::text('twitter_handle', $settings->twitter_handle, ['class' => 'form-control'])!!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="google_plus_url"><i class="fa fa-google-plus"></i> Google Plus URL</label>
                    {!!Form::text('google_plus_url', $settings->google_plus_url, ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="linkedin_url"><i class="fa fa-linkedin-square"></i> LinkedIn URL</label>
                    {!!Form::text('linkedin_url', $settings->linkedin_url, ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="facebook_url"><i class="fa fa-facebook-square"></i> Facebook URL</label>
                    {!!Form::text('facebook_url', $settings->facebook_url, ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 form-group">
                    <label for="rss_feed_url"><i class="fa fa-rss"></i> RSS Feed URL</label>
                    {!!Form::text('rss_feed_url', $settings->rss_feed_url, ['class' => 'form-control'])!!}
                    <span class="help-block"><small><strong>Note: </strong>For using alternative RSS feed URLs (Feedburner,
                        etc.). Default will be used if left blank.
                    </small></span>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="advanced">
            <div class="row">
                <div class="col-md-12">
                    {!!Form::label('page_cache_timeout','Page Cache Timeout (in Seconds)')!!}
                </div>
                <div class="col-md-2 form-group">
                    {!!Form::text('page_cache_timeout', $settings->page_cache_timeout, ['class' => 'form-control'])!!}
                </div>
            </div>
{{--             <div class="row">
                <div class="col-md-12">
                    {!!Form::label('db_cache_time','Database Cache Timeout (in Minutes)')!!}
                </div>
                <div class="col-md-2 form-group">
                    {!!Form::text('db_cache_time', $settings->db_cache_time, ['class' => 'form-control'])!!}
                </div>
            </div> --}}
            <div class="panel panel-danger">
                <div class="panel-heading">ReCaptcha</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label>
                            {!! Form::checkbox('enable_recaptcha', '1', $settings->enable_recaptcha, ['id' =>
                            'enable_recaptcha']) !!}
                            Enable ReCaptcha
                        </label>
                    </div>
                    <div class="form-group">
                        {!!Form::label('recaptcha_public_key','ReCaptcha Public Key')!!}
                        {!!Form::text('recaptcha_public_key', $settings->recaptcha_public_key, ['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('recaptcha_private_key','ReCaptcha Private Key')!!}
                        {!!Form::text('recaptcha_private_key', $settings->recaptcha_private_key, ['class' =>
                        'form-control'])!!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    {!!Form::label('disqus_short_name','Disqus Short Name')!!}
                    {!!Form::text('disqus_short_name', $settings->disqus_short_name, ['class' => 'form-control'])!!}
                </div>
            </div>
        </div>
        <div class="tab-pane" id="email">
            <div class="row">
                <div class="col-md-12 form-group">
                    {!!Form::label('email_username','Email Username')!!}
                    {!!Form::text('email_username', $settings->email_username, ['class' => 'form-control'])!!}
                </div>
                <div class="col-md-12 form-group">
                    {!!Form::label('email_password','Email Password')!!}
                    {!!Form::text('email_password', $settings->email_password, ['class' => 'form-control'])!!}
                </div>
                <div class="col-md-12 form-group">
                    {!!Form::label('email_smtp_server','Email SMTP Server')!!}
                    {!!Form::text('email_smtp_server', $settings->email_smtp_server, ['class' => 'form-control'])!!}
                </div>
                <div class="col-md-2 form-group">
                    {!!Form::label('email_port','Email Port')!!}
                    {!!Form::text('email_port', $settings->email_port, ['class' => 'form-control'])!!}
                </div>
            </div>
        </div>
    </div>

    {!!Form::submit('Update',['class' => 'btn btn-primary'])!!}
    @stop
