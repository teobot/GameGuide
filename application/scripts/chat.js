// $(document).ready(function() {

//     //Connect to the server
//     var socket = io('http://localhost:8080');

//     // Check every second if the client has connected to the chat server
//     setInterval(
//         function(){
//             //If the socket connection is succesful
//             if (socket.connected) {
//                 //enabled the chat button
//                 document.getElementById("chatButton").disabled = false;
//             }
//             else {
//                 //client cannot connect to the chat server so disable the button
//                 document.getElementById("chatButton").disabled = true;
//             }
//         },1000);

//     $( "#sendComment" ).click(function() {
//         console.log($("#message").get(0).value);
//         var username;

//         if($('#username_tag').data("username") == "") {
//             username = "Anon"
//         } else {
//             username = $('#username_tag').data("username");
//         }
        
//         socket.emit("client message", $("#message").get(0).value, username);

//         $("#message").get(0).value = "";
//     });

//     socket.on("server message", function(username, message) {
//         $("#textChat").append('<li class="list-group-item animated fadeIn">'+username+': '+message+'</li>');
//     });
    
// });