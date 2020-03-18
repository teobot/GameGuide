$( document ).ready(function() {
    //This checks all the switch buttons that have the class "checked-active",
    //This is used when the user loads the account page, it will dynamically load the toggled buttons
    $('.checked-active').prop('checked', true);
});

$("#postCommentForm").submit(function(form){
    //This prevents the default behavior of the form that normally submits to a page location,
    //Instead we just want to gather the data from the post function so we disable the form submission behavior
    form.preventDefault();
});

$('#admin_switch').click(function() {
    //This is function is for the administrator mode toggle button, if the button is enabled then the account type admin is set off to
    //be added into the database, otherwise the account type is cleaned and removed.
    if ($(this).is(':checked')) {
        //If the user clicks to enable the toggle
        $.post("http://localhost/PHPFrameworks/index.php/setAdmin", {accountType: "admin"})
        .done(function( data ) {
            $('#changes').prepend('<div class="text-center alert-success mb-1 animated fadeIn"><small>Admin Enabled</small></div>')
        });
    } else {
        //If the user clicks to disable the toggle
        $.post("http://localhost/PHPFrameworks/index.php/setAdmin", {accountType: ""})
        .done(function( data ) {
            $('#changes').prepend('<div class="text-center alert-success mb-1 animated fadeIn"><small>Admin Disabled</small></div>')
        });
    } 
});

$('#darkmode_switch').click(function() {
    //This function is for the darkmode enabled toggle button, if the button is enabled then the darkMode field in the database is enabled
    //By replacing the value with the number 1 or 0 (1 being enabled)(0 being disabled)
    if ($(this).is(':checked')) {
        //Switch has been enabled, turn darkmode On
        $.post("http://localhost/PHPFrameworks/index.php/setDarkMode", {darkMode: 1})
        .done(function( data ) {
            //Enabled darkMode so remove the current lightMode classes and enable the darkMode version
            $("#navigationBar").removeClass("navbar-dark");
            $("#navigationBar").removeClass("bg-dark");
            $("#navigationBar").addClass("navbar-light");
            $("#navigationBar").addClass("bg-light");
            $("body").addClass("text-light bg-dark");

            //Submit changes to the change log on the account screen
            $('#changes').prepend('<div class="text-center alert-success mb-1 animated fadeIn"><small>DarkMode Enabled</small></div>')
        });
    } else {
        //Switch has been disabled, turn darkmode Off
        $.post("http://localhost/PHPFrameworks/index.php/setDarkMode", {darkMode: 0})
        .done(function( data ) {

            //Disable darkMode so remove the current darkMode classes and enable the LightMode version
            $("#navigationBar").removeClass("navbar-light");
            $("#navigationBar").removeClass("bg-light");
            $("#navigationBar").addClass("navbar-dark");
            $("#navigationBar").addClass("bg-dark");
            $("body").removeClass("text-light bg-dark");
            
            //Submit the changes to the change log on the account screen
            $('#changes').prepend('<div class="text-center alert-success mb-1 animated fadeIn"><small>DarkMode Disabled</small></div>')
        });
    } 
});

$('.profile-image-selection').click(function() {
    //This function updates the profile image of the user to the selected one
    $.post("http://localhost/PHPFrameworks/index.php/setProfileImage", {image: this.value})
    .done(function( data ) {
        $('#changes').prepend('<div class="text-center alert-success mb-1 animated fadeIn"><small>Profile Image Updated!</small></div>')
    });
});