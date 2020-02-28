const http = require("http");

var app = http.createServer();

http.createServer(function (request, response) {
    response.writeHead(200 , { 'Content-type': 'text/plain' });
}).listen(8081);

var io = require("socket.io")(app);

io.on("connection", function(socket) {
    
    console.log("Someone has connected!");

    io.emit("server message", "Hello and welcome");

    socket.on("client message", function(data) {
        console.log("Client Message received: " + data);
        io.emit("server message", data);
    });

    socket.on('disconnect', function(){
        console.log('user disconnected');
    });
    
});

app.listen(8080, function(response) {
    console.log("Server started! listening on localhost:8080");
});