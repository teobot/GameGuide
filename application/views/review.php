<div class="container" style="margin-bottom:56px;">
        <div class="w3-panel">
                <!-- Review Title -->
                <h1 style="font-size: 3.25em;font-weight: 900;"><?php echo $review["review_title"]; ?></h1>
                <!-- Review Subtitle and rating -->
                <h1 class="text-muted" style="font-size: 1.75em;font-weight: normal">
                        <?php echo $review["review_subtitle"]; ?>
                        <span class="badge badge-pill badge-danger text-monospace">
                                <?php echo $review["review_rating"]; ?>/10
                        </span>
                </h1>

                <!-- Review Publisher and author name -->
                <div class="d-flex justify-content-start">
                        <p class="review-tag">By <?php echo $review["review_author"]; ?>, </p>
                        <p class="review-tag">Published: <?php echo $review["review_timestamp"]; ?></p>
                </div>
                <!-- Image main image -->
                <div style="width:100%;height:250px;background: url(<?php echo $review["review_image"]; ?>) no-repeat center; background-size: cover;"></div>
                <hr>
                <!-- Verdict container -->
                <h1 style="font-weight: 900;">Verdict</h1>
                <p class="container" style="font-size: 1.25rem;line-height: 32px;"><?php echo $review["review_text"]; ?></p>
                <!-- Comment section container -->
                <div id="commentSection" class="container">
                        <!-- Comment section header -->
                        <h1 style="font-weight: 900;">Comments</h1>
                        <?php
                        //Display the comment box if the user is logged in
                        if($loggedIn) {
                                //The user is logged in so display the message post input
                                $push_comment = base_url("index.php/review/" . $review["slug"]);
                                echo<<<_END
                                <div class="container-fluid">
                                        <form id="postCommentForm" class="form-inline">
                                                <div class="form-group mx-sm-3 mb-2">
                                                        <input type="text" name="comment" class="form-control" placeholder="Comment...">
                                                </div>
                                                <button id="postCommentButton" v-on:click="postComment" class="btn btn-primary mb-2">Submit</button>
                                        </form>
                                </div>
_END;
                        }
                        ?>
                        <!-- Comment container area -->
                        <div class="container-fluid">
                                <!-- ForEach comment on the review get this container -->
                                <div v-for="comment in comments" class="row w3-card m-0 mb-1 p-0 container-fluid align-items-center">
                                        <!-- User profile image -->
                                        <div class="col-1 align-items-center" style="width: 50px;">
                                                <div class="comment-profile-image" :style="{ backgroundImage: `url(${comment.profile_image})` }"></div>
                                        </div>
                                        <!-- username, comment and account type container -->
                                        <div class="col-5">
                                                <h5>
                                                        <!-- comment username -->
                                                        {{comment.username}} -
                                                        <!-- If user is admin display admin badge, otherwise display user -->
                                                        <a v-if="comment.admin" class="badge badge-pill badge-info animated infinite pulse slow">Admin</a>
                                                        <small class="text-muted" v-else>User</small>
                                                </h5>
                                                <p>
                                                        <!-- Display comment message -->
                                                        {{comment.message}}
                                                </p>
                                        </div>
                                        <!-- Display current timestamp on the end -->
                                        <div class="col">
                                                <div style="text-align: right" class="mr-3 blockquote-footer"><small>{{comment.timestamp}}</small></div>
                                        </div>
                                </div>
                        </div>
                </div>
                <br>
        </div>
</div>