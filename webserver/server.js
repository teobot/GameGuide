var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

app.listen(8080, function(response) {
    console.log("Server started! listening on localhost:8080");
});

//This writes the head of the server page, meaning that when I try to connect I can check the head for the response code
function handler (req, res) {
    //Change the servers index.html response code to 200 meaning that the server has been created correctly
    //This reads its own index page file
    fs.readFile(__dirname + '/index.html',
    function (err, data) {
        if (err) {
            res.writeHead(500);
            return res.end('Error loading index.html');
        }
        res.writeHead(200);
        res.end(data);
    });
}

io.on("connection", function(socket) {
    console.log("User has connected to the server!");
    var newUserConnection = true;

    if(newUserConnection) {
        //New User connection
        io.emit("server message", "Server", "Welcome to the server!");
        newUserConnection = false;
    }

    socket.on("client message", function(username, message, acountType) {
        console.log("Client Message received from " + username + " message: " + message);
        io.emit("server message", username, message);
    });

    socket.on('disconnect', function(){
        console.log('User has disconnected from the server!');
    });
    
});
