//This is the client Side chat system script
//
//Users:
//Users are given a unique name if they choose not to login before entering the chat,
//This is so that when a chatroom is entered the chatlog is sent to the correct user instead of everyone.
//Once a user has logged in, information such as name and account type are returned to be used within messages.
//
//Chatrooms:
//ChatRooms are defined by the ChatRoom object, which include a "chatroomName" and "usersAllowed",
//usersAllowed is a array of user types that are allowed into said room, if the current userType is not included within the array,
//the user is not granted access to view or send messages to the chatroom, If you wish to create a new Chatroom just add a new chatRoom object,
//the code is built around being scalable, the server side chatSystem also will then return any and all messages on the new chatRoom, no need to change any code there.
//This allows me to dynamically add as many chatRooms as I want without having to paste add more code then the chatrooms, Just make sure the userAllowed users can actually become that type of user.
var socket = io('http://localhost:8080');
var chatSystem = new Vue({
  el: '#globalChat',
  data: {
    username: "Anon"+Math.floor(Math.random() * 1000000000),
    userLoggedIn: false,
    userType: "standard",
    admin: false,
    isConnected: false,
    messages: [],
    currentChatroom: "",
    messageToPost: "",
    chatRooms: [
      {
        chatroomName:"General",
        usersAllowed: [
          "member",
          "admin",
          "standard"
        ]
      },
      {
        chatroomName:"Member & Admin",
        usersAllowed: [
          "member",
          "admin"
        ]
      },
      {
        chatroomName:"Anon & Admin",
        usersAllowed: [
          "standard",
          "admin"
        ]
      },
      {
        chatroomName:"Anon Only",
        usersAllowed: [
          "standard"
        ]
      },
      {
        chatroomName:"Admin Only",
        usersAllowed: [
          "admin"
        ]
      },
      {
        chatroomName:"Member Only",
        usersAllowed: [
          "member",
          "admin"
        ]
      },
    ]
  },
  created() {
    //On Created I check if the user is logged in and I can retrieve their details, if not then the currently set default details will be used.
    this.updateUserDetails();
    //I also assign the default user chat room to be chatroom 1 or (0), which is the general chat.
    this.currentChatroom = this.chatRooms[0];
    
    //If the client receives a server chatlog message, check if the username is the same, if so then replace all currently displayed messages with the messages from the server.
    socket.on("server chatlog", function(chatlog, username) {
      if(username == chatSystem.username) {
        chatSystem.messages = chatlog;
        chatSystem.messages.push({ "username":"CHAT CHANGE", "message":"You have entered chatroom: " + chatSystem.currentChatroom.chatroomName, "admin":true });
        chatSystem.ScrollToBottom();
      }      
    });

    socket.on("server message", function(username, message, chatroom, admin) {
      //This is a server message, if the user is in the current chatroom and the user has access to that chatroom,
      //display the message, also it checks if the message received is from the same user, if so then it turns the message to green to represent that you sent that message.
        if(chatroom == chatSystem.currentChatroom.chatroomName) {
          if(chatSystem.doesUserHaveAccess()) {
            var senderIsReceiver = false;
            if(chatSystem.username == username) {
              senderIsReceiver = true;
            }
            chatSystem.messages.push({ "username":username, "message":message, "admin":admin, "ownMessage":senderIsReceiver});
            chatSystem.ScrollToBottom();
          }
        }    
    });

    setInterval( function(){
      //GET THE LATEST VERSION OF THE USERS DETAILS
      chatSystem.updateUserDetails();
      //If the socket connection is successful
      if (socket.connected) {
        //If the socket is connected to the server then enable the chatbutton
        if(!chatSystem.isConnected) {
          //If the connect turn from FALSE to TRUE then the user must be just connected, so retrieve the current chatlog for the current server,
          //This statement won't trigger if the connection has gone from TRUE to TRUE or FALSE to FALSE.
          socket.emit("client chatlog request", "General", chatSystem.username );
        }
        //enable the chat button as the user has connected to the webserver
        chatSystem.isConnected = true;
        document.getElementById("chatButton").disabled = false;
      } else {
        //client cannot connect to the chat server so disable the button
        chatSystem.isConnected = false;
        document.getElementById("chatButton").disabled = true;
      }
      //Set the default interval time to 750 which is 3/4 Seconds
    },750);
  },
  watch: {
    //This is a event listener, it listens for changes in the current chatRoom value, which will only change if the user has moved channel,
    //Since the user has moved channel I need to check if they have the correct permissions, if they don't then I push a "Error not allowed access" message,
    //otherwise, I send a chatlog request off to retrieve the current chatlog from the server.
    'currentChatroom': function(newVal, oldVal) {
      if(chatSystem.doesUserHaveAccess()) { 
        //If the user does have access, then send off for a chatlog
        socket.emit("client chatlog request", chatSystem.currentChatroom.chatroomName, chatSystem.username );
        //Emit a message saying that the user has joined the chatroom
        socket.emit("client message", chatSystem.username, "Has Joined the Chatroom", newVal.chatroomName, false );
        //Emit a message saying that the user has left the chatroom
        socket.emit("client message", chatSystem.username, "Has Left the Chatroom", oldVal.chatroomName, false );
      } else {
        //If the user doesn't have access then remove any messages and send a "no access" message.
        chatSystem.messages = [];
        chatSystem.messages.push({ "username":"CHAT CHANGE", "message":"You do not have access to: " + chatSystem.currentChatroom.chatroomName, "admin":true });
        chatSystem.ScrollToBottom();
      }
    }    
  },
  methods: {
    //This function retrieves the form data and posts the message to the server, The character cap is between 1-30 characters, otherwise it displays a error
    sendMessage:function() {
      //If the user has typed anything
      if(chatSystem.messageToPost) {
        //If the message to post it less then 30 characters, otherwise show a error message
        if(chatSystem.messageToPost.length > 30) {
          //If the message is over 30 characters long
          chatSystem.messages.push({ "username":"ERROR", "message":"Message To Long (MAX 30 Characters)", admin:true });
          chatSystem.ScrollToBottom();
          return;
        }
        //Checking if the user can post to that chatroom
        if(chatSystem.doesUserHaveAccess()) {
          //If they have access then allow the post of the message
          socket.emit("client message", chatSystem.username, chatSystem.messageToPost, chatSystem.currentChatroom.chatroomName, chatSystem.admin );
        } else {
          //otherwise, then user doesn't have permissions to post then show a incorrect privileges in chatroom message
          chatSystem.messages.push({ "username":"ERROR", "message":"Incorrect privileges in chatroom!", admin:true });
          chatSystem.ScrollToBottom();
        }
        //Remove the message from the form post box
        chatSystem.messageToPost = '';
      }
    },
    updateUserDetails:function() {
      //This function gathers the account details, from codeIgniter, if the user is logged in then the username is overwritten,
      //The user is given the userLoggedIn status and whether the user is a admin or not given the admin status
      $.get("http://localhost/PHPFrameworks/index.php/getAccountDetails", function(data) {
        if(!data.failed) {
          //If the data does exist populate any fields it can
          chatSystem.username = data.username;
          chatSystem.admin = data.isAdmin;
          if(data.isAdmin) {
            chatSystem.userType = "admin";
          } else {
            chatSystem.userType = "member";
          }
          chatSystem.userLoggedIn = true;
        } 
      });
    },
    doesUserHaveAccess:function() {
      //This function decides if the user has read/write privileges in the current chatroom
      var access = false;
      $.each(chatSystem.currentChatroom.usersAllowed, function( index, value ) {
        //For each of the allowed users check if that is equal to the current user type
        if(value == chatSystem.userType) {
          access = true;
          return;
        }
      });
      //If so then allow access
      //I have to return True; here in another if statement as the previous return is inside a forEach loop, so will only return out of that loop
      if(access) {
        return true;
      } else {
        return false;
      }     
    },
    ScrollToBottom:function() {
      //This function waits 1/2 second and then scrolls down to the bottom of the chatlog, This is useful for when a user posts a message to the server so the user can read it instantly.
      setTimeout(function(){
        $("#textChat").scrollTop($("#textChat")[0].scrollHeight);
      }, 500); 
    }
  }
});