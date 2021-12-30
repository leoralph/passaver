$(document).ready(function(){
    $('.passaver-modal').click(function (){
        $.ajax({
            url: $(this).attr('href'),
            data: {
                modal_title: $(this).attr('title'),
                modal_size: $(this).attr('size'),
                modal_color: $(this).attr('color')
            }
        }).done(function(result){
            $('#myModal').html(result)
            $('#myModal').modal('show')
        })
    })
})