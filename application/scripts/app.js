$( document ).ready(function() {
    $('.checked-active').prop('checked', true);
});

$('#admin_switch').click(function() {

    if ($(this).is(':checked')) {
        $.post("http://localhost/PHPFrameworks/index.php/setAdmin", {accountType: "admin"})
        .done(function( data ) {
            console.log( "Data Loaded: " + data );
        });
    } else {
        $.post("http://localhost/PHPFrameworks/index.php/setAdmin", {accountType: ""})
        .done(function( data ) {
            console.log( "Data Loaded: " + data );
        });
    }
    
});