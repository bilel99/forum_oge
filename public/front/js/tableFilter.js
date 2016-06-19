/**
 * Created by bilel on 18/06/2016.
 */
$(document).ready(function () {

    $('.star').on('click', function () {
        $(this).toggleClass('star-checked');
    });

    $('.ckbox label').on('click', function () {
        $(this).parents('tr').toggleClass('selected');
    });

    $('.btn-filter').on('click', function () {
        var $target = $(this).data('target');
        if ($target != 'all') {
            if($('.table tr[data-status="' + $target + '"]').length == 0){
                $('.table tr').css('display', 'none');
                $('.aucun').fadeIn('slow');
            }else{
                $('.aucun').fadeOut('slow');
                $('.table tr').css('display', 'none');
                $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
            }
        } else {
            $('.aucun').fadeOut('slow');
            $('.table tr').css('display', 'none').fadeIn('slow');
        }
    });

});