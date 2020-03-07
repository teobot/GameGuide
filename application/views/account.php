<div class="container"><br>
    <h1 class="display-4 text-center">Account Settings</h1>
    <?php echo $err;?>

    <div class="row justify-content-center" style="margin-bottom:56px;">

        <form class="w3-card m-2" action="<?php echo base_url("index.php/account/update-details");?>" method="post">
            <div class=""><br>
                <div class="container">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" min="1" max="128" class="form-control" name="username" value="<?php echo $username;?>">
                        <small id="usernameHelp" class="form-text text-muted">This is your display name, Please make it unique!</small>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" min="1" max="128" class="form-control" name="password" value="<?php echo $password;?>" >
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div><br>
            </div>
        </form>

        <div class="w3-card m-2" id="profile_image_selection"><br>
            <div class="container" v-for="image in images">

                <div class="m-1">
                    <label style="height:25px;width:25px;">
                        <input class="profile-image-selection" type="radio" name="profile_image" :value="image">
                        <img style="height:25px;width:25px;" :src="image">
                    </label>
                </div>
                
            </div><br>
        </div>

        <div class="w3-card m-2"><br>
            <div class="container">

                <div class="custom-control custom-switch m-1">
                    <input type="checkbox" class="custom-control-input <?php echo $adminChecked;?>" id="admin_switch">
                    <label class="custom-control-label active" for="admin_switch">Administration</label>
                </div>

                <div class="custom-control custom-switch m-1">
                    <input type="checkbox" class="custom-control-input <?php echo $darkModeChecked;?>" id="darkmode_switch">
                    <label class="custom-control-label active" for="darkmode_switch">Dark Mode</label>
                </div><hr>

                <div class="container w3-card" id="changes" style="height:150px;overflow: scroll;overflow-x: hidden; width:200px">
                        <div class="text-center m-1"><small class="text-muted">end of changes</small></div>
                </div>

            </div><br>
        </div>




    </div>   
    <br>
</div>