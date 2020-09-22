<?php get_header('header.php') ?>
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="<?php echo home_url() ?>"><i class="fa fa-home"></i> Home</a>
                    <a href="<?php echo home_url('/blog') ?>">Blog</a>
                    <span><?php do_action('os_breadcumb') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <?php if (have_posts()) { ?>
                <?php while (have_posts()) {
                    the_post() ?>
                    <div class="col-lg-8 col-md-8">

                        <div class="blog__details__content">

                            <div class="blog__details__item">
                                <?php if (has_post_thumbnail()) { ?>
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?>" alt="">
                                <?php } ?>
                                <div class="blog__details__item__title">
                                    <?php do_action('os_post_cat', get_the_ID()) ?>
                                    <h4><?php echo get_the_title() ?></h4>
                                    <ul>
                                        <li>by <span><?php echo  get_the_author() ?></span></li>
                                        <li><?php echo  get_the_date('M d, Y') ?></li>
                                        <li><?php echo  get_comments_number(get_the_ID()) ?> Comments</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="blog__details__desc">
                                <p><?php echo get_the_content() ?></p>
                            </div>

                            <div class="blog__details__tags">
                                <?php do_action('os_post_tag', get_the_ID()) ?>
                            </div>

                            <div class="blog__details__btns">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 p-2">
                                        <div class="text-center blog__details__btn__item">
                                            <h6><?php do_action('os_prev_post_link') ?></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 p-2">
                                        <div class="text-center blog__details__btn__item blog__details__btn__item--next">
                                            <h6><?php do_action('os_next_post_link') ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog__details__comment">
                                <?php comments_template() ?>
                            </div>
                        </div><!-- blog__details__content end -->
                    </div><!-- col-lg-8 col-md-8 end -->
                <?php } ?>
                <div class="col-lg-4 col-md-4">
                    <?php get_sidebar('blog') ?>
                </div>
            <?php } ?>
        </div><!-- row end -->
    </div><!-- container end -->
</section><!-- section end -->
<!-- Blog Details Section End -->
<?php get_footer('footer.php') ?>