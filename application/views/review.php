<div class="container" style="margin-bottom:56px;">
        <div class="w3-panel">
                <h1 style="font-size: 3.25em;font-weight: 900;"><?php echo $review["review_title"]; ?></h1>
                <h1 class="text-muted" style="font-size: 1.75em;font-weight: normal"><?php echo $review["review_subtitle"]; ?></h1>

                <div class="d-flex justify-content-start">
                        <p class="review-tag">By <?php echo $review["review_author"]; ?>, </p>
                        <p class="review-tag">Published: <?php echo $review["review_timestamp"]; ?></p>
                </div>
                <div style="width:100%;height:250px;background: url(<?php echo $review["review_image"]; ?>) no-repeat center; background-size: cover;"></div>
                <hr>
                <h1 style="font-weight: 900;">Verdict</h1>
                <p class="container" style="font-size: 1.25rem;line-height: 32px;"><?php echo $review["review_text"]; ?></p>
        </div>
</div>