@extends('layouts.master')
@section('title','Search Results for "' . $q. '"')
@section('meta-description', '')
@section('content')
@if($posts->count())
@foreach($posts as $post)
@include('partials.post_intro')
@endforeach
@else
<div class="alert alert-info">No results.</div>
@endif
@endsection
