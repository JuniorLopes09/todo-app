@extends('layouts.app')

@section('content')
    <home-component csrf_token="{{ @csrf_token() }}"></home-component>
@endsection
