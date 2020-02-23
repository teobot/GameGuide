    </body>

<!-- Modal -->
    <div id="globalChat" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chatBoxLabel">Global Chat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="max-height:300px;overflow: auto;">
                <ul id="textChat" class="list-group list-group-flush">
                    
                </ul>
                </div><br>
                    <div id="messageBox">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><?php echo $this->input->cookie("username"); ?></span>
                            </div>
                            <input type="text" class="form-control" placeholder="message" id="message" autocomplete="off">
                        </div>
                    </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="sendComment">Send</button>
                    </div>
            </div>
        </div>
    </div>

    <!-- Load in the required scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Don't forget to load in Vue abd socket.io -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>


    <!-- This section needs editing to create the chat system using HTML -->
    <div class="fixed-bottom bg-dark d-flex flex-row justify-content-between align-items-center" style="height:56px;color:white;">
        <div class="p-2 d-flex justify-content-center align-items-center">
            <div style="height:48px;width:48px; background: url(https://theoclapperton.live/img/profile.jpg) no-repeat center; background-size: cover;margin-right:5px;"></div>
            <h5 style="margin: 0px">Theo Clapperton, 18055445</h5>
        </div>
        <div class="p-2" style="width:200px;">
            <button id="chatButton" data-toggle="modal" data-target="#globalChat" class="open-button btn btn-sm btn-block btn-success">Chat</button>
        </div>
    </div>

<!-- Load in your custom scripts -->
<script src="<?php echo base_url("application/scripts/CustomVue.js"); ?>"></script>
</html>