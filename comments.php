        <?php if (get_comments_number(get_the_ID()) == 0) { ?>
            <h5>0 Comment</h5>
        <?php } else { ?>
            <h5><?php echo get_comments_number(get_the_ID())  ?> Comment</h5>
        <?php } ?>
        <?php if (have_comments()) : ?>
            <?php do_action('os_list_comment'); ?>

            <?php if (get_previous_comments_link() || get_next_comments_link()) { ?>
                <div class="blog__details__btns">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 p-2">
                            <div class="text-center blog__details__btn__item">
                                <h6><?php previous_comments_link('<i class="fa fa-angle-left"></i> Previous') ?></h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 p-2">
                            <div class="text-center blog__details__btn__item blog__details__btn__item--next">
                                <h6><?php next_comments_link('Next <i class="fa fa-angle-right"></i>') ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        <?php else : // This is displayed if there are no comments so far. 
        ?>

            <?php if (comments_open()) : ?>
                <!-- If comments are open, but there are no comments. -->

            <?php else : // Comments are closed. 
            ?>
                <!-- If comments are closed. -->
                <p class="nocomments"><?php _e('Comments are closed.'); ?></p>

            <?php endif; ?>
        <?php endif; ?>

        <?php comment_form(); ?>