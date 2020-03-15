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
    this.updateUserDetails();
    this.currentChatroom = this.chatRooms[0];
    
    socket.on("server chatlog", function(chatlog, username) {
      if(username == chatSystem.username) {
        console.log(chatlog);
        chatSystem.messages = chatlog;
        chatSystem.messages.push({ "username":"CHAT CHANGE", "message":"You have entered chatroom: " + chatSystem.currentChatroom.chatroomName, "admin":true });
      }      
    });

    socket.on("server message", function(username, message, chatroom, admin) {
        if(chatroom == chatSystem.currentChatroom.chatroomName) {
          if(chatSystem.doesUserHaveAccess()) {
            var senderIsReciever = false;
            if(chatSystem.username == username) {
              senderIsReciever = true;
            }
            chatSystem.messages.push({ "username":username, "message":message, "admin":admin, "ownMessage":senderIsReciever});
          }
        }    
    });

    setInterval( function(){
      //GET THE LATEST VERSION OF THE USERS DETAILS
      chatSystem.updateUserDetails();
      //If the socket connection is succesful
      if (socket.connected) {
        if(!chatSystem.isConnected) {
          socket.emit("client chatlog request", "General", chatSystem.username );
        }
        //enabled the chat button
        chatSystem.isConnected = true;
        document.getElementById("chatButton").disabled = false;
      } else {
        //client cannot connect to the chat server so disable the button
        chatSystem.isConnected = false;
        document.getElementById("chatButton").disabled = true;
      }
      $("#textChat").scrollTop($("#textChat")[0].scrollHeight);
    },750);
  },
  watch: {
    'currentChatroom': function(newVal, oldVal) {
      if(chatSystem.doesUserHaveAccess()) { 
        socket.emit("client chatlog request", chatSystem.currentChatroom.chatroomName, chatSystem.username );
      } else {
        chatSystem.messages = [];
        chatSystem.messages.push({ "username":"CHAT CHANGE", "message":"You do not have access to: " + chatSystem.currentChatroom.chatroomName, "admin":true });
      }
    }    
  },
  methods: {
    sendMessage:function() {
      if(chatSystem.messageToPost) {
        if(chatSystem.messageToPost.length > 30) {
          chatSystem.messages.push({ "username":"ERROR", "message":"Message To Long (MAX 30 Characters)", admin:true });
          return;
        }
        if(chatSystem.doesUserHaveAccess()) {
          socket.emit("client message", chatSystem.username, chatSystem.messageToPost, chatSystem.currentChatroom.chatroomName, chatSystem.admin );
        } else {
          chatSystem.messages.push({ "username":"ERROR", "message":"Incorrect privileges in chatroom!", admin:true });
        }
        chatSystem.messageToPost = '';
      }
    },
    updateUserDetails:function() {
      $.get("http://localhost/PHPFrameworks/index.php/getAccountDetails", function(data) {
        if(!data.failed) {
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
      var access = false;
      $.each(chatSystem.currentChatroom.usersAllowed, function( index, value ) {
        if(value == chatSystem.userType) {
          access = true;
          return;
        }
      });
      if(access) {
        return true;
      } else {
        return false;
      }     
    }
  }
});