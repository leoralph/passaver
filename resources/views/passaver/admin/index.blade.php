@extends('passaver.templates.base')
@section('title', 'Passaver - Painel de Admin')
@section('content')
    <div class="container">
        <form action="{{route('admin.arquivos')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="arquivo" id="arquivo">
            <input type="submit" value="">
        </form>
    </div>
@endsection