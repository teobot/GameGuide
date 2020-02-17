<?php $this->load->view('template/header'); ?>

<div class="container"><br>
    <?php
    foreach ($result as $row)
    {
        // This is presuming you have a column in your database table called ReviewImage.
        $thisTitle = $row->review_title;
        // Look into the image properties library in CodeIgniter for more help on images: 

        echo<<<_END
        <div class="card" style="height:350px;width:200px;background-color:red;float:left;margin: 0px 5px 0px 5px;">
            <h5>$thisTitle</h5>
        </div>
_END;
        
    }
    ?>

    <div class="card" style="height:350px;width:200px;background-color:red;float:left;margin: 0px 5px 0px 5px;">
        
    </div>
</div>

<?php $this->load->view('template/footer'); ?>
