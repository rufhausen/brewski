@extends('layouts.master')
@section('title', 'Category:')
@section('sub_title', $category->name)
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
