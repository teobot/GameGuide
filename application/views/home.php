
<div class="container">
    <div class="row justify-content-center" style="margin-bottom:56px;">
        <?php
        foreach ($result as $row)
        {
            //Retrieve the needed variables from each result and display a card using the heredoc below
            $thisTitle = $row->review_title;
            $thisImage = $row->review_image;
            $thisSlug = $row->slug;

            //Wrap each div in a href so the user can click anywhere to view the review
            $slugRoute = site_url('review/'.$thisSlug);
            echo<<<_END
            <a href="$slugRoute">
                <div class="w3-card review-card animated zoomIn" style="position: relative; background: url($thisImage) no-repeat center; background-size: cover;">
                    <div style="height:100px;width:100%;position:absolute;bottom:0;">
                        <div style="height:100%;width:100%;background-color:#CD4436;position:absolute;bottom:0;opacity: 0.75;"></div>
                        <h3 class="text-center" style="color:white;font-size:1.5em;font-weight:900;position:relative;">$thisTitle</h3>
                    </div>
                </div>
            </a>
_END;
            
        }
        ?>
    </div>
</div><br>