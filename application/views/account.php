<div class="container"><br>
    <h1 class="display-4 text-center">Account Settings</h1>
    <?php echo $err;?>

    <form class="row justify-content-center" style="margin-bottom:56px;" action="<?php echo base_url("index.php/account/update-details");?>" method="post">

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

        <div class="w3-card m-2"><br>
            <div class="container">

                <div class="m-1">
                    <label style="height:25px;width:25px;">
                        <input type="radio" name="profile_image" value="0" checked>
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


    </form>   
    <br>
</div>