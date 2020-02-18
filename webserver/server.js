var app = require("http").createServer();

var io = require("socket.io")(app);

io.on("connection", function(socket) {
    console.log("Someone has connected!");

    socket.on("client message", function(data) {
        console.log("Client Message received: " + data);

        io.emit("server message", data);
    });
});

app.listen(8080, function() {
    console.log("Server started!");
});