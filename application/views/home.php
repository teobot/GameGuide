<?php $this->load->view('template/header'); ?>

<div class="container justify-content-between">
    <?php
    foreach ($result as $row)
    {
        // This is presuming you have a column in your database table called ReviewImage.
        $thisTitle = $row->review_title;
        $thisImage = $row->review_image;
        // Look into the image properties library in CodeIgniter for more help on images: 

        echo<<<_END

        <div class="w3-card review-card animated zoomIn" style="float:left;position: relative; background: url($thisImage) no-repeat center; background-size: cover;">
        
            <div style="height:100px;width:100%;position:absolute;bottom:0;">
                <div style="height:100%;width:100%;background-color:#CD4436;position:absolute;bottom:0;opacity: 0.75;"></div>
                <h3 class="text-center" style="color:white;font-size:1.5em;font-weight:900;position:relative;">$thisTitle</h3>
            </div>
        
        </div>
_END;
        
    }
    ?>
</div>

<?php $this->load->view('template/footer'); ?>
