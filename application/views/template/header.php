<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Link CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url("application/css/style.css?") . time() ;?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="<?php echo base_url("application/scripts/chat.js?") . time(); ?>"></script>
        <title>18055445-CWK</title>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand">Games Review</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url("index.php"); ?>">Home</a></li>
                </ul>
            </div>
            <span class="navbar-text">
                <?php
                    if( $this->input->cookie("username") ) {
                        //User is logged In
                        $notyou = base_url("index.php/not-you");
                        $username = $this->input->cookie("username");
                        echo<<<_END
                        <ul class="navbar-nav">
                            <li class="nav-item w3-card"><div class="nav-link active">Welcome, $username!</div></li>
                            <li class="nav-item"><small><a class="nav-link text-muted" href="$notyou">Not you?</a></small></li></ul>
_END;
                    } else {
                        //User is not logged In
                        $login = base_url("index.php/Login");
                        $register = base_url("index.php/register");
                        echo<<<_END
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="$login">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="$register">Register</a></li>
                        </ul>
_END;                        
                    }
                ?>
            </span> 
        </nav>
    </head>

    <?php
    // Manipulate the body CSS colour here.
    ?>
    <body>
        <br>