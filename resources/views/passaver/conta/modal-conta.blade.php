@extends('passaver.templates.modal')

@section('modal-size', 'xl')

@section('modal-color', 'primary')

@section('modal-title', empty($conta->id) ? 'CADASTRAR CONTA' : 'CONSULTAR CONTA')

@section('form-action', route('passaver.conta.salvar'))

@section('modal-body')
    @csrf
    <input type="hidden" name="senha_id" value="{{Crypt::encryptString($senha_id)}}">
    <input type="hidden" name="conta_id" value="{{Crypt::encryptString($conta->id)}}">
    <div class="row">
        <div class="col">
            <label for="apelido" class="form-label">Apelido da Conta:</label>
            <input type="text" name="apelido" value="{{$conta->apelido}}" id="apelido" class="form-control">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <label for="credencial" class="form-label">Credencial da Conta:</label>
            <input type="text" name="credencial" value="{{$conta->credencial}}" id="credencial" class="form-control">
        </div>
    </div>
    <div class="row mt-2">
        <label for="senha" class="form-label">Senha da Conta:</label>
        <div class="col input-group">
            <input type="password" name="senha" id="senha" value="{{$senha}}" class="form-control">
            <button class="btn btn-outline-primary" type="button" id="gerar-senha"><i class="bi-magic"></i></button>
            <button class="btn btn-outline-primary" type="button" id="ver-senha"><i id="icone-olho" class="bi-eye"></i></button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col text-end">
        </div>
    </div>
    <script>
        $('#ver-senha').click(function(){
            inputSenha = $('#senha');

            if(inputSenha.attr('type') == 'password'){
                inputSenha.attr('type', 'text');
                $('#icone-olho').removeClass();
                $('#icone-olho').addClass('bi-eye-slash')
            } else {
                inputSenha.attr('type', 'password');
                $('#icone-olho').removeClass();
                $('#icone-olho').addClass('bi-eye');
            }
        });
        $('#gerar-senha').click(function(){
            $.get({
                url: $('#_url').val() + '/senha/gerar'
            }).done(function(result){
                $('#senha').val(result);
            });
        });
    </script>
@endsection
    
@section('modal-footer')
    <button type="submit" class="btn btn-success">Salvar</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
@endsection