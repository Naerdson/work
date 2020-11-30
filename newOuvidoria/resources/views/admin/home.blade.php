@extends('admin.layouts.master')
@section('content')
    @if(Session::has('message') && Session::has('type'))
        <div class="alert alert-{{ Session::get('type') }} text-center">{{ Session::get('message') }}</div>
    @endif
    <h2 class="title-h">Ouvidoria Unifametro</h2>

@endsection
