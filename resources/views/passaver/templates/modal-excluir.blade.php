@extends('passaver.templates.modal')

@section('modal-color', 'warning')

@section('modal-title', 'EXLUIR ITEM')

@section('form-action', route('passaver.confirmar-exclusao'))

@section('modal-body')
    @csrf
    @method('delete')
    <input type="hidden" name="target" value="{{$target}}">
    <input type="hidden" name="case" value="{{$case}}">
    Deseja confirmar a exclusão do item?
@endsection
    
@section('modal-footer')
    <button type="submit" class="btn btn-success"><i class="bi-check-lg"></i> Sim</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi-x-lg"></i> Não</button>
@endsection