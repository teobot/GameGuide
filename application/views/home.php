<?php $this->load->view('template/header'); ?>

<div class="container d-flex justify-content-between">
    <?php
    foreach ($result as $row)
    {
        // This is presuming you have a column in your database table called ReviewImage.
        $thisTitle = $row->review_title;
        $thisImage = $row->review_image;
        // Look into the image properties library in CodeIgniter for more help on images: 

        echo<<<_END
        <div class="w3-card review-card">
            <h5>$thisTitle</h5>
            <img src="$thisImage" class="img-fluid" alt="Responsive image">
        </div>
_END;
        
    }
    ?>

    <div class="w3-card review-card">
        
    </div>
</div>

<?php $this->load->view('template/footer'); ?>
