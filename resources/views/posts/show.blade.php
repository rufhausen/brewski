@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div>{{ $post->published_at }}</div>
        <h2>{!! $post->title !!}</h2>
        <ul class="share-list">
            <li>
                <a class="btn btn-twitter btn-xs" href="#"
                onclick="window.open('http://twitter.com/share?url={{$post->url}}&text={{{addslashes($post->title)}}}', 'newwindow', 'width=400, height=250'); return false;"><span
                class="fa fa-twitter"></span> Twitter</a>
            </li>
            <li>
                <a class="btn btn-facebook btn-xs" href="#"
                onclick="window.open('http://www.facebook.com/sharer/sharer.php?s=100&p[url]={{$post->url}}&p[images][0]=&p[title]={{{addslashes($post->title)}}}&p[summary]=', 'newwindow', 'width=400, height=250'); return false;"><span
                class="fa fa-facebook"></span> Facebook</a>
            </li>
            <li>
                <a class="btn btn-google-plus btn-xs" href="#"
                onclick="window.open('https://plus.google.com/share?url={{$post->url}}', 'newwindow', 'width=500, height=430'); return false;"><span
                class="fa fa-google-plus"></span> Google+</a></li>
                <li>
                    <a class="btn btn-linkedin btn-xs" href="http://www.linkedin.com/shareArticle?mini=true&url={{$post->url}}" target="_blank"><i class="fa fa-linkedin-square"></i> LinkedIn</a>
                </li>
            </ul>

            <p>{!! $post->content !!}</p>
        </div>
    </div>
    @endsection
