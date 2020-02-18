<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="chat.js?<?php echo time(); ?>"></script>
    </head>  
    <body>
        <div id="enter">
            <form>
                <button id="sendbutton">Send</button>
                <input type="text" id="message" autocomplete="off">
            </form>
        </div>
        <div id="chatspace"></div>
    </body> 
</html>