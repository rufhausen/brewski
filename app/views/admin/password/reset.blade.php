@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default" style="margin-top: 40px;">
            <form action="{{ action('RemindersController@postReset') }}" method="POST">
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="email" name="email">
                <input type="password" name="password">
                <input type="password" name="password_confirmation">
                <input type="submit" value="Reset Password">
            </form>
        </div>
    </div>
</div>
