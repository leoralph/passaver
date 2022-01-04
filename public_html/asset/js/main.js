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
        });
    });

    $('.excluir-item').click(function(){
        $.ajax({
            url: $('#_url').val() + '/excluir',
            data: {
                _csrf: $('#_csrf').val(),
                case: $(this).attr('case'),
                target: $(this).attr('id')
            },
            method: 'GET'
        }).done(function(result){
            $('#myModal').html(result);
            $('#myModal').modal('show');
        });
    });

    $("#pesquisar").on("keyup", function() {
        var busca = $(this).val().toLowerCase();
    
        $("table tr").each(function(index) {
            if (index !== 0) {
                var tds = $(this).find("td");
                var textoTd = tds.text().toLowerCase();
                
                if (textoTd.includes(busca)){
                    $(this).show();
                }
                else {
                    $(this).hide();
                }
            }
        });
    });
});