<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Link CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
        <link rel="stylesheet" href="<?php echo base_url("application/css/style.css"); echo("?" . time()) ?>">
        <title><?php echo $title?></title>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Games Review</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url("index.php"); ?>">Home</a></li>
                </ul>
            </div>
            <span class="navbar-text">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url("index.php/login"); ?>">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url("index.php"); ?>">Register</a></li>
                </ul>
            </span> 
        </nav>
    </head>

    <?php
    // Manipulate the body CSS colour here.
    ?>
    <body>
        <br>