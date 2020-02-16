<html>
<head>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Link CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


<title><?php echo $title?></title>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Games Review</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
</head>

<?php
// Manipulate the body CSS colour here.
?>

<div class="container">
    <div class="row">
        <?php
        foreach ($result as $row)
        {
            // These classes onlywork if you attach Bootstrap.
            echo '<div class="card cardBodyWidth '.$cssBodyClass.'">';
            // This is presuming you have a column in your database table called ReviewImage.
            $thisImage = $row->ReviewImage;
            // Look into the image properties library in CodeIgniter for more help on images: 
            
        }
        ?>
    </div>
</div>
</body>

<!--
    <button id="chatButton" class="open-button btn btn-success" onclick="openForm()">Chat</button>
    <div class="chat-popup pull-right" id="myForm">
        <form id="myform" class="form-container">
        </form>
    </div>
-->

<!-- This section needs editing to create the chat system using HTML -->
<div class="fixed-bottom bg-dark d-flex flex-row justify-content-between align-items-center" style="height:56px;color:white;">
    <div class="p-2 d-flex justify-content-center align-items-center">
        <div style="height:48px;width:48px; background: url(https://theoclapperton.live/img/profile.jpg) no-repeat center; background-size: cover;margin-right:5px;"></div>
        <h5 style="margin: 0px">Theo Clapperton, 18055445</h5>
    </div>
    <div class="p-2" style="width:200px;">
        <button id="chatButton" class="open-button btn btn-sm btn-block btn-success" onclick="openForm()">Chat</button>
        <div class="chat-popup pull-right" style="display:none;" id="myForm">
            <form id="myform" class="form-container">
            </form>
        </div>
    </div>
</div>

<!-- Load in the required scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Don't forget to load in Vue abd socket.io -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>




<!-- Load in your custom scripts -->

</html>