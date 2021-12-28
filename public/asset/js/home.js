$('.mostrar-senha').click(function(){
    event.preventDefault()
    $(this).siblings('.input-senha').val($(this).attr('id'))
})