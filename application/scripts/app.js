$( document ).ready(function() {
    $('.checked-active').prop('checked', true);
});

$('#admin_switch').click(function() {
    if ($(this).is(':checked')) {
        $.post("http://localhost/PHPFrameworks/index.php/setAdmin", {accountType: "admin"})
        .done(function( data ) {
            console.log( "Data Loaded: " + data );
            $('#changes').prepend('<div class="text-center alert-success mb-1 animated fadeIn"><small>Admin Enabled</small></div>')
        });
    } else {
        $.post("http://localhost/PHPFrameworks/index.php/setAdmin", {accountType: ""})
        .done(function( data ) {
            console.log( "Data Loaded: " + data );
            $('#changes').prepend('<div class="text-center alert-success mb-1 animated fadeIn"><small>Admin Disabled</small></div>')
        });
    } 
});

$('.profile-image-selection').click(function() {
    console.log();
    //Update the profile image and click the checkbox
    $.post("http://localhost/PHPFrameworks/index.php/setProfileImage", {image: this.value})
    .done(function( data ) {
        console.log( "Data Loaded: " + data );
        $('#changes').prepend('<div class="text-center alert-success mb-1 animated fadeIn"><small>Profile Image Updated!</small></div>')
    });
});