$( document ).ready(function() {
    $('.checked-active').prop('checked', true);
});

$("#postCommentForm").submit(function(form){
    form.preventDefault();
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

$('#darkmode_switch').click(function() {
    if ($(this).is(':checked')) {
        //Switch has been enabled, turn darkmode On
        $.post("http://localhost/PHPFrameworks/index.php/setDarkMode", {darkMode: 1})
        .done(function( data ) {
            console.log( "Data Loaded: " + data );
            $("#navigationBar").removeClass("navbar-dark");
            $("#navigationBar").removeClass("bg-dark");
            $("#navigationBar").addClass("navbar-light");
            $("#navigationBar").addClass("bg-light");

            $("body").addClass("text-light bg-dark");
            $('#changes').prepend('<div class="text-center alert-success mb-1 animated fadeIn"><small>DarkMode Enabled</small></div>')
        });
    } else {
        //Switch has been disabled, turn darkmode Off
        $.post("http://localhost/PHPFrameworks/index.php/setDarkMode", {darkMode: 0})
        .done(function( data ) {
            console.log( "Data Loaded: " + data );
            $("#navigationBar").removeClass("navbar-light");
            $("#navigationBar").removeClass("bg-light");
            $("#navigationBar").addClass("navbar-dark");
            $("#navigationBar").addClass("bg-dark");

            $("body").removeClass("text-light bg-dark");
            $('#changes').prepend('<div class="text-center alert-success mb-1 animated fadeIn"><small>DarkMode Disabled</small></div>')
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