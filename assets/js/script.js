$( document ).ready(function() {
    $('#login p a ').on('click', function() {
       $('#login').hide();
       $('#sign-up').show();
    });

    $('#sign-up p a ').on('click', function() {
        $('#sign-up').hide();
        $('#login').show();
    });
});