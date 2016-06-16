/**
 * Created by bilel on 13/03/2016.
 */
/**
 * Archive / Actif
 */
$(document).ready(function(){
    $('.btn-delete').click(function(e){
        e.preventDefault();
        var row = $(this).parents('li');
        var id = row.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':REPONSE_ID', id);
        var data = form.serialize();

        $.post(url, data, function(result){
            //console.log(result);
            $('#post_'+result.id).empty();

            // Affichage du message avec notiJs
            $('#message_info').append(notie.alert(1, result.message, 5));


        }).fail(function(){
            sweetAlert('Oups...', 'Une erreur est survenue', 'error');
            row.show();
        });
    });
});

/**
 * FIN
 */