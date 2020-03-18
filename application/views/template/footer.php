    </body>

<!-- ChatSystem container Start  -->
    <div id="globalChat" class="modal fade text-secondary" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <!-- Chat Header -->
                <div class="p-0 m-2 align-items-middle">
                    <!-- Header -->
                    <span class="h3">Chat</span><hr class="mt-2 mb-2">
                    <!-- Chat Select group, using VueJS -->
                    <span class="h6">Chat Select:</span>
                    <select class="custom-select col-9" v-model="currentChatroom">
                        <option v-for="chatroom in chatRooms" :value="chatroom">{{chatroom.chatroomName}}</option>
                    </select>
                </div>
                <!-- Chat Header End -->

                <!-- Status container -->
                <div class="border align-items-middle">
                    <!-- Logged In status -->
                    <span v-if="userLoggedIn" class="ml-2 text-muted small" >Status: Logged in</span><span v-else class="ml-2 text-muted small">Status: Not logged in</span><br>
                    <!-- Username -->
                    <span class="ml-2 text-muted small">Username: {{username}}</span><br>
                    <!-- User Type -->
                    <span class="ml-2 text-muted small">User Type: {{userType}}</span>
                </div> 
                
                <div class="modal-body">

                    <!-- Chat Message output area -->
                    <div id="textChat" style="max-height: 300px;overflow: auto;">
                        <div class="list-group list-group-flush" >
                            <!-- Chat message output container Start -->
                            <div class="container animated fadeIn border-bottom" v-for="message in messages">  
                                <div class="row justifty-content-start mb-1 mt-1">
                                    <!-- Message username container -->
                                    <span class="align-middle" :class="{ 'bg-success text-white' : message.ownMessage, 'bg-info text-white' : message.admin }" > {{message.username}} </span>
                                    <!-- Message comment container -->
                                    <span class="align-middle text-muted">: {{message.message}} </span>
                                </div>
                            </div>
                            <!-- Container End -->
                        </div>
                    </div><br>

                    <!-- Message input container -->
                    <div id="messageBox">
                        <div class="input-group mb-3">
                            <!-- Translate input to VueJS using v-model -->
                            <input v-model="messageToPost" min="0" max="30" type="text" class="form-control" placeholder="message" id="message" autocomplete="off">
                            <div class="input-group-prepend">
                                <!-- Message length container -->
                                <span class="input-group-text small align-middle">{{messageToPost.length}}/30</span>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- ChatSystem send comment and close model here -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button v-on:click="sendMessage" class="btn btn-primary" id="sendComment">Send</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Load in the required scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- load in Vue and socket.io -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

    <!-- Load the footer which is stuck along the bottom of the window -->
    <div class="fixed-bottom bg-dark d-flex flex-row justify-content-between align-items-center" style="height:56px;color:white;">
        <div class="p-2 d-flex justify-content-center align-items-center">
            <div style="height:48px;width:48px; background: url(https://theoclapperton.live/img/profile.jpg) no-repeat center; background-size: cover;margin-right:5px;"></div>
            <h5 style="margin: 0px">Theo Clapperton, 18055445</h5>
        </div>
        <div class="p-2" style="width:200px;">
            <button id="chatButton" data-toggle="modal" data-target="#globalChat" class="open-button btn btn-sm btn-block btn-success">Chat</button>
        </div>
    </div>
    <!-- Loading in custom scripts -->
    <script src="<?php echo base_url("application/scripts/CustomVue.js") ?>"></script>
    <script src="<?php echo base_url("application/scripts/app.js") ?>"></script>
    <script src="<?php echo base_url("application/scripts/ClientChatSystem.js?") ?>"></script>

</html>