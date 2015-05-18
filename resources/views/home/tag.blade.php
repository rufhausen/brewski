@extends('layouts.master')
@section('title', 'Tag:')
@section('sub_title', strtoupper($tag->name))
@section('meta-description', '')
@section('content')
@if($posts->count())
@foreach ($posts as $post)
@include('partials.post_intro')
@endforeach
<div id="pagination">
    {{$posts->render()}}
</div>
@else
<div class="alert alert-info">No published posts at this time.</div>
@endif
@stop
