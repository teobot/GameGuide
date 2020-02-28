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

$('.profile-image-selection').click(function() {
    console.log();
    //Update the profile image and click the checkbox
    $.post("http://localhost/PHPFrameworks/index.php/setProfileImage", {image: this.value})
    .done(function( data ) {
        console.log( "Data Loaded: " + data );
        $('#changes').prepend('<div class="text-center alert-success m-1"><small>Profile Image Updated!</small></div>')
    });
});