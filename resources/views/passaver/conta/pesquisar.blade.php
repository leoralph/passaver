@foreach ($contas->get() as $conta)    
    <tr id="{{$conta->id*2}}">
        <td>{{$loop->iteration}}</td>
        <td>{{$conta->apelido}}</td>
        <td class="text-center">
            <button href="{{route('passaver.conta.consultar', ['id' => Crypt::encryptString($conta->id)])}}" class="btn btn-secondary btn-sm passaver-modal"><i class="bi-search"></i></button>
        </td>
        <td class="text-center px-0">
            <button id="{{Crypt::encryptString($conta->id)}}" case="{{Crypt::encryptString(1)}}" class="btn excluir-item btn-primary btn-sm"><i class="bi-trash"></i></button>
        </td>
    </tr>
@endforeach
<script src="{{asset('asset/js/main.js')}}"></script>