@extends('layouts.app')

@section('title', 'Create New User')

@section('content')
<h1>hai {{ Auth::user()->name ?? '' }}</h1>

@endsection