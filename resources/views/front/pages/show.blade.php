@extends('front.templates.app')

@section('body')
    <h1>{{ $data['page']['title'] }}</h1>

    <p>{{ $data['page']['description'] }}</p>
@endsection
