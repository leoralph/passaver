@if (!empty($messages))
    {{print_r($messages)}}
@endif
Seu email ainda não foi verificado <a href="{{route('verification.send')}}">Clique aqui</a> para enviar novamente