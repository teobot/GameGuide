<div class="container"><br>
    <h1 class="display-4 text-center">Account Settings</h1>
    <?php echo $err;?>

    <div class="row justify-content-center" style="margin-bottom:56px;">

        <form action="<?php echo base_url("index.php/account/update-details");?>" method="post">
            <div class="w3-card m-2"><br>
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

        <div class="w3-card m-2"><br>
            <div class="container" id="profile_image_sele">

                <div class="m-1">
                    <label style="height:25px;width:25px;">
                        <input type="radio" name="profile_image" value="0">
                        <img style="height:25px;width:25px;" src="<?php echo base_url("application/images/profile_images/default.jpg")?>">
                    </label>
                </div>

                <div class="m-1">
                    <label style="height:25px;width:25px;">
                        <input type="radio" name="profile_image" value="1">
                        <img style="height:25px;width:25px;" src="<?php echo base_url("application/images/profile_images/mmuDark.jpg")?>">
                    </label>
                </div>

                <div class="m-1">
                    <label style="height:25px;width:25px;">
                        <input type="radio" name="profile_image" value="2">
                        <img style="height:25px;width:25px;" src="<?php echo base_url("application/images/profile_images/mmu.jpg")?>">
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
                    <input type="checkbox" class="custom-control-input" id="customSwitch2">
                    <label class="custom-control-label" for="customSwitch2">Dark Mode</label>
                </div>

            </div><br>
        </div>




    </div>   
    <br>
</div>