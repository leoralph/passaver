$('.mostrar-senha').click(function(){
    event.preventDefault();
    inputSenha = $(this).closest('td').prev('td').children('input');
    $.ajax({
        url: $(this).attr('href')
    }).done(function(result){
        inputSenha.val(result)
    });
})
$('.excluir-conta').click(function(){
    event.preventDefault();
    $.ajax({
        url: $(this).attr('href')
    }).done(function(result){
        location.reload();
    });
})