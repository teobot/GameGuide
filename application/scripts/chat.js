$(document).ready(function() {

    var socket = io.connect("http://localhost:8080");

    $( "#sendComment" ).click(function() {
        console.log($("#message").get(0).value);
        socket.emit("client message", $("#message").get(0).value);
        $("#message").get(0).value = "";
    });

    socket.on("server message", function(data) {
        $("#textChat").append('<li class="list-group-item animated fadeIn">'+data+'</li>');
    });
    
});