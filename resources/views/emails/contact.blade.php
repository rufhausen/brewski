@extends('emails.layouts.master')
@section('content')
<h3>{{ \Cache::get('settings')['site_name'] }} Contact Email</h3>
<p>
    <h4>Name</h4>
    {{$name}}
</p>
<p>
    <h4>Email</h4>
    {{$email}}
</p>
<p>
    <h4>Messsage</h4>
    {{$content}}
</p>
@endsection
