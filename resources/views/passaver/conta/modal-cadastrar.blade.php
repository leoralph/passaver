@extends('passaver.templates.modal')

@section('modal-size', 'xl')

@section('modal-color', 'primary')

@section('modal-title', 'CADASTRAR CONTA')

@section('form-action', route('conta.salvar'))

@section('modal-body')
    @csrf
    <div class="row">
        <div class="col">
            <label for="apelido" class="form-label">Apelido da Conta:</label>
            <input type="text" name="apelido" id="apelido" class="form-control">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <label for="credencial" class="form-label">Credencial da Conta:</label>
            <input type="text" name="credencial" id="credencial" class="form-control">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <label for="senha" class="form-label">Senha da Conta:</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col text-end">
        </div>
    </div>
@endsection
    
@section('modal-footer')
    <button type="submit" class="btn btn-success">Salvar</button>
    <button class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
@endsection