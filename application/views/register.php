<div class="container w3-card"><br>
    <h1 class="display-4">Account Creation</h1>

    <!-- Display error messages -->
    <?php echo $err; ?>
    
    <!-- Registration form start -->
    <form action="<?php echo base_url("index.php/register");?>" method="post" class="container">
        <div class="form-group">
            <label>Username</label>
            <input type="text" min="1" max="128" class="form-control" name="username">
            <small id="usernameHelp" class="form-text text-muted">This is your display name, Please make it unique!</small>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" min="1" max="128" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form><br>

</div>