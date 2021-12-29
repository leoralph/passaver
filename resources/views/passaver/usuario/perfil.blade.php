@extends('passaver.templates.base')
@section('title', 'Passaver - Perfil')
@section('content')
    {{Auth::user()}}
@endsection