// Require the node modules used 
var app = require('http').createServer(handler)
//Require the socket.io module and give it the http server
var io = require('socket.io')(app);
var fs = require('fs');

//Start http server on port 8080 and listen for responses
app.listen(8080, function(response) {
    console.log("Server started! listening on localhost:8080");
});

//This writes the head of the server page, meaning that when I try to connect I can check the head for the response code
function handler (req, res) {
    //Change the servers index.html response code to 200 meaning that the server has been created correctly
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

//Create a empty array to store the chatmessages
var chatLogMessages = [];

//On a connect from a client
io.on("connection", function(socket) {
    console.log("User has connected to the server!");

    //The client has requested a chatlog, so through each message and if was sent to the same chatroom return it
    socket.on("client chatlog request", function(chatroom, username) {
        //Create a empty return array of message
        var chatLogReturn = [];
        for (const element of chatLogMessages) {
            //For each message check the chatroom and if it matches the requested chatroom messages add it to the array,
            //This is completely scalable, as a new chatroom can be created and no more code has to be added here.
            if(element.chatroom == chatroom) {
                chatLogReturn.push(element);
            }
        }
        //When finished emit the chatlog back to the users client
        io.emit("server chatlog", chatLogReturn, username);
    });

    //If the client has sent a message to the server
    socket.on("client message", function(username, message, chatroom, admin) {
        //Console log the message sent
        console.log("Client Message received from " + username + " message: " + message + " chatroom: " + chatroom);
        //Emit the message back to the chatroom
        io.emit("server message", username, message, chatroom, admin);
        //Add the new message to the array of the chatlog
        chatLogMessages.push({username:username,message:message,admin:admin,chatroom:chatroom});
    });

    //If the user disconnects from the server, display a user has disconnected message
    socket.on('disconnect', function(){
        console.log('User has disconnected from the server!');
    });
    
});
