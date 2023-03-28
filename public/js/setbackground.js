$(document).ready(function() {
    /*------------------
        Background Set
    --------------------*/
    $('.image-cover').each(function () {
        let bg = $(this).attr('bg');
        $(this).css('background-image', 'url(' + bg + ')');
    });
});
