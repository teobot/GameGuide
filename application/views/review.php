<div class="container" style="margin-bottom:56px;">
        <div class="w3-panel">
                <h1 style="font-size: 3.25em;font-weight: 900;"><?php echo $review["review_title"]; ?></h1>
                <h1 class="text-muted" style="font-size: 1.75em;font-weight: normal"><?php echo $review["review_subtitle"]; ?><span class="badge badge-pill badge-danger text-monospace"><?php echo $review["review_rating"]; ?>/10</span></h1>

                <div class="d-flex justify-content-start">
                        <p class="review-tag">By <?php echo $review["review_author"]; ?>, </p>
                        <p class="review-tag">Published: <?php echo $review["review_timestamp"]; ?></p>
                </div>
                <div style="width:100%;height:250px;background: url(<?php echo $review["review_image"]; ?>) no-repeat center; background-size: cover;"></div>
                <hr>
                <h1 style="font-weight: 900;">Verdict</h1>
                <p class="container" style="font-size: 1.25rem;line-height: 32px;"><?php echo $review["review_text"]; ?></p>
                <h1 style="font-weight: 900;">Comments</h1>

                <?php
                        if($loggedIn) {
                                $push_comment = base_url("index.php/review/" . $review["slug"]);
                                echo<<<_END
                                <div class="container-fluid">
                                        <form class="form-inline" method="post" action="$push_comment">
                                                <div class="form-group mx-sm-3 mb-2">
                                                        <input type="text" name="comment" class="form-control" placeholder="Comment...">
                                                </div>
                                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                        </form>
                                </div>
_END;
                        }

                ?>
                <div id="commentSection" class="container">
                        <div v-for="comment in comments">
                                <div class="w3-card d-flex flex-row justify-content-left align-items-center" style="padding: 2px 2px 2px 2px; margin: 5px 0px 5px 0px;">
                                        <div class="p-2">
                                                <div class="comment-profile-image" :style="{ backgroundImage: `url(<?php echo base_url("application/images/profile_images");?>${comment.profile_image})` }"></div>
                                        </div>
                                        <div class="p-2">
                                                <h5 style="margin: 0px 0px 0px 0px;">
                                                        {{comment.username}} -
                                                        <a v-if="comment.admin" class="badge badge-pill badge-info animated infinite pulse slow">Admin</a>
                                                        <small class="text-muted" v-else>User</small>
                                                </h5>
                                                <p style="margin: 0px 0px 0px 0px;">
                                                        {{comment.message}}
                                                </p>
                                        </div>
                                </div>   
                        </div>
                </div>



                <br>
        </div>
</div>