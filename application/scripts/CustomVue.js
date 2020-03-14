var commentElement = new Vue({
    // Add the id here.
    el: '#commentSection',
    data: {
      comments:[]
    }, 
    created() {
      this.getComments();
    },   
    methods: {
      getComments:function()
      {
        var pathArray = window.location.pathname.split('/');
        $.get("http://localhost/PHPFrameworks/index.php/getComments",{"slug":pathArray[4]}, function(data){
          console.log(data);
          commentElement.comments = data;
        });
        
      },
      postComment:function() {
        var comment = $("#postCommentForm").serializeArray();
        var pathArray = window.location.pathname.split('/');
        console.log(pathArray)

        $.post("http://localhost/PHPFrameworks/index.php/postComment",{ "slug":pathArray[4], "comment":comment[0].value }, function(data){
          //CLEAR THE TEXT AREA
          console.log(data);
          //SHOW A SUBMITTED TEXT
          commentElement.getComments();
        });
      }
    }
});

var profile_images = new Vue({
  el: '#profile_image_selection',
  data: {
    images:[
      "https://moonvillageassociation.org/wp-content/uploads/2018/06/default-profile-picture1.jpg",
      "https://store.playstation.com/store/api/chihiro/00_09_000/container/US/en/999/UP1675-CUSA11816_00-AV00000000000044/1580198354000/image?w=240&h=240&bg_color=000000&opacity=100&_version=00_09_000",
      "https://store.playstation.com/store/api/chihiro/00_09_000/container/US/en/999/UP5588-CUSA16013_00-AV00000000000044/1580197048000/image?w=240&h=240&bg_color=000000&opacity=100&_version=00_09_000",
      "https://store.playstation.com/store/api/chihiro/00_09_000/container/US/en/999/UP1112-CUSA06917_00-AV00000000000180/1580207723000/image?w=240&h=240&bg_color=000000&opacity=100&_version=00_09_000",
      "https://store.playstation.com/store/api/chihiro/00_09_000/container/US/en/999/UP5325-CUSA15500_00-AV00000000000003/1580197389000/image?w=240&h=240&bg_color=000000&opacity=100&_version=00_09_000",
      "https://store.playstation.com/store/api/chihiro/00_09_000/container/US/en/999/UP5588-CUSA16013_00-AV00000000000047/1580197046000/image?w=240&h=240&bg_color=000000&opacity=100&_version=00_09_000",
    ]
  }, 
});

var socket = io('http://localhost:8080');
var chatSystem = new Vue({
  el: '#globalChat',
  data: {
    username: "Anon"+Math.floor(Math.random() * 1000000000),
    userLoggedIn: false,
    currentChatroom: "General",
    admin: false,
    isConnected: false,
    messages: [],
    messageToPost: "",
    chatRooms: [
      "General",
      "Admin Only",
      "Member Only"
    ]
  },
  created() {
    $.get("http://localhost/PHPFrameworks/index.php/getAccountDetails", function(data) {
      console.log(data);
      if(!data.failed) {
        chatSystem.username = data.username;
        chatSystem.admin = data.isAdmin;
        chatSystem.userLoggedIn = true;
      } 
    });

    socket.on("server chatlog", function(chatlog, username) {
      chatSystem.messages = chatlog;
      console.log(chatlog)
      var objDiv = document.getElementById("textChat");
      objDiv.scrollTop = objDiv.scrollHeight;
    });

    socket.on("server message", function(username, message, chatroom, admin) {
        if(chatroom == chatSystem.currentChatroom) {
          if(chatSystem.currentChatroom == "Admin Only" && !chatSystem.admin) {
            return;
          } else if(chatSystem.currentChatroom == "Member Only" && !chatSystem.userLoggedIn) {
            return;
          } else {
            //Instead of pushing the new message to the array I use Unshift as this pushes the new message to the top instead,
            //Therefore new messages will show at the top not the bottom
            chatSystem.messages.push({ "username":username, "message":message, "admin":admin });
          }
        }    
    });

    setInterval( function(){
      //If the socket connection is succesful
      if (socket.connected) {
        //enabled the chat button
        chatSystem.isConnected = true;
        document.getElementById("chatButton").disabled = false;
      } else {
        //client cannot connect to the chat server so disable the button
        chatSystem.isConnected = false;
        document.getElementById("chatButton").disabled = true;
      }
    },500);
  },
  watch: {
    'currentChatroom': function(newVal, oldVal) {
      if(chatSystem.currentChatroom == "Admin Only" && chatSystem.admin) {
        socket.emit("client chatlog request", chatSystem.currentChatroom );
      } else if(chatSystem.currentChatroom == "Member Only" && chatSystem.userLoggedIn) {
        socket.emit("client chatlog request", chatSystem.currentChatroom );
      } else if (chatSystem.currentChatroom == "General") {
        socket.emit("client chatlog request", chatSystem.currentChatroom );
      } else {
        chatSystem.messages = [];
      }
    }    
  },
  methods: {
    sendMessage:function() {
      if(chatSystem.messageToPost) {
        if(chatSystem.messageToPost.length > 30) {
          chatSystem.messages.push({ "username":"ERROR", "message":"Message To Long (MAX 30 Characters)" });
          return;
        }
        if(chatSystem.currentChatroom == "Admin Only" && chatSystem.admin) {
          //USER WANTS TO SEND MESSAGE TO ADMIN ONLY AND IS A ADMIN
          socket.emit("client message", chatSystem.username, chatSystem.messageToPost, chatSystem.currentChatroom, chatSystem.admin );
        } else if(chatSystem.currentChatroom == "Member Only" && chatSystem.userLoggedIn) {
          //USER WANTS TO SEND DATA TO THE MEMBER ONLY AND IS LOGGED IN
          socket.emit("client message", chatSystem.username, chatSystem.messageToPost, chatSystem.currentChatroom, chatSystem.admin );
        } else if (chatSystem.currentChatroom == "General") {
          //USER JUST WANTS TO SEND A MESSAGE TO THE GROUP CHAT
          socket.emit("client message", chatSystem.username, chatSystem.messageToPost, chatSystem.currentChatroom, chatSystem.admin );
        } else {
          //IF THE USER TRIES TO POST IN A CHATROOM WITHOUT CORRECT PRIVILEGES
          chatSystem.messages.push({ "username":"ERROR", "message":"Incorrect privileges in chatroom!" });
        }
        chatSystem.messageToPost = '';
      }
    },
  }
});