@extends('layouts.master')

@section('content')

Click here to reset your password: {{ url('admin/password/reset/'.$token) }}

@endsection
