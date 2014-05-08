@extends('Admin::layouts.master')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default" style="margin-top: 40px;">
            <div class="panel-heading"><strong>{{Cache::get('options')->site_name}}</strong></div>
            <div class="panel-body">
                <form action="{{ action('RemindersController@postRemind') }}" method="POST" role="form" class="form">
                    <div class="form-group col-md-6">
                        <input type="email" name="email" placeholder="Email Address" class="form-control"><br/>
                        <input type="submit" value="Send Reminder" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @stop
