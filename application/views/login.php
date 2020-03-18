<div class="container w3-card"><br>
    <h1 class="display-4">Login</h1>
    <!-- Display any errors here if needed -->
    <?php
        echo $err;
    ?>
    <!-- Form for logging into the system Start -->
    <form action="" method="post" class="container">
        <div class="form-group">
            <label >Username</label>
            <input name="username" min="0" max="64" type="text" class="form-control">
            <small class="form-text text-muted">Please enter your username here.</small>
        </div>
        <div class="form-group">
            <label >Password</label>
            <input name="password" type="password" min="0" max="64" class="form-control">
            <small class="form-text text-muted">Enter you password here.</small>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form><br>
</div>