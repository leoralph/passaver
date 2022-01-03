@extends('passaver.templates.modal')

@section('modal-size', 'xl')

@section('modal-color', 'primary')

@section('modal-title', 'SALVAR ARQUIVO')

@section('form-action', route('arquivo.salvar'))

@section('complemento-form', 'enctype=multipart/form-data')

@section('modal-body')
    @csrf
    <label for="arquivo" class="form-label">Inserir arquivos:</label>
    <input type="file" name="arquivos[]" id="arquivo" multiple class="form-control">
@endsection
    
@section('modal-footer')
    <button type="submit" class="btn btn-success">Salvar</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
@endsection