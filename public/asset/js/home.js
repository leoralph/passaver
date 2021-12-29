$('.mostrar-senha').click(function(){
    event.preventDefault();
    inputSenha = $(this).closest('td').prev('td').children('input');
    $.ajax({
        url: $(this).attr('url')
    }).done(function(result){
        inputSenha.val(result)
    });
})