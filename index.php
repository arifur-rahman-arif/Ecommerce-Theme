<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * @package Online Exam
 * @since Online Exam 1.0.0
 */
get_header('header.php') ?>
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <span><?php do_action('os_breadcumb') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <?php if (have_posts()) { ?>
                <?php $count = 0 ?>
                <?php $item_size = 'large__item' ?>

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <?php while (have_posts()) {
                        the_post(); ?>
                        <?php $count++ ?>
                        <?php if ($count <= 3) { ?>
                            <?php if ($count % 2) { ?>
                                <div class="blog__item">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div onclick="window.location='<?php echo get_the_permalink() ?>'" class="blog__item__pic set-bg" data-setbg="<?php echo  get_the_post_thumbnail_url() ?>"></div>
                                    <?php } ?>
                                    <div class="blog__item__text">
                                        <h6><a href="#"><?php echo get_the_title() ?></a></h6>
                                        <ul>
                                            <li>by <span><?php echo  get_the_author() ?></span></li>
                                            <li><?php echo  get_the_date('M d, Y') ?></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="blog__item">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div onclick="window.location='<?php echo get_the_permalink() ?>'" class="blog__item__pic <?php echo $item_size ?> set-bg" data-setbg="<?php echo  get_the_post_thumbnail_url() ?>"></div>
                                    <?php } ?>
                                    <div class="blog__item__text">
                                        <h6><a href="#"><?php echo get_the_title() ?></a></h6>
                                        <ul>
                                            <li>by <span><?php echo  get_the_author() ?></span></li>
                                            <li><?php echo  get_the_date('M d, Y') ?></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <?php $count = 0 ?>
                    <?php while (have_posts()) {
                        the_post(); ?>
                        <?php $count++ ?>
                        <?php if ($count <= 6 && $count > 3) { ?>
                            <?php if ($count % 2) { ?>
                                <div class="blog__item">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div onclick="window.location='<?php echo get_the_permalink() ?>'" class="blog__item__pic set-bg" data-setbg="<?php echo  get_the_post_thumbnail_url() ?>"></div>
                                    <?php } ?>
                                    <div class="blog__item__text">
                                        <h6><a href="#"><?php echo get_the_title() ?></a></h6>
                                        <ul>
                                            <li>by <span><?php echo  get_the_author() ?></span></li>
                                            <li><?php echo  get_the_date('M d, Y') ?></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="blog__item">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div onclick="window.location='<?php echo get_the_permalink() ?>'" class="blog__item__pic <?php echo $item_size ?> set-bg" data-setbg="<?php echo  get_the_post_thumbnail_url() ?>"></div>
                                    <?php } ?>
                                    <div class="blog__item__text">
                                        <h6><a href="#"><?php echo get_the_title() ?></a></h6>
                                        <ul>
                                            <li>by <span><?php echo  get_the_author() ?></span></li>
                                            <li><?php echo  get_the_date('M d, Y') ?></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>


                <div class="col-lg-4 col-md-4 col-sm-6">
                    <?php $count = 0 ?>
                    <?php while (have_posts()) {
                        the_post(); ?>
                        <?php $count++ ?>
                        <?php if ($count > 6) { ?>
                            <?php if ($count % 2) { ?>
                                <div class="blog__item">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div onclick="window.location='<?php echo get_the_permalink() ?>'" class="blog__item__pic set-bg" data-setbg="<?php echo  get_the_post_thumbnail_url() ?>"></div>
                                    <?php } ?>
                                    <div class="blog__item__text">
                                        <h6><a href="#"><?php echo get_the_title() ?></a></h6>
                                        <ul>
                                            <li>by <span><?php echo  get_the_author() ?></span></li>
                                            <li><?php echo  get_the_date('M d, Y') ?></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="blog__item">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <div onclick="window.location='<?php echo get_the_permalink() ?>'" class="blog__item__pic <?php echo $item_size ?> set-bg" data-setbg="<?php echo  get_the_post_thumbnail_url() ?>"></div>
                                    <?php } ?>
                                    <div class="blog__item__text">
                                        <h6><a href="#"><?php echo get_the_title() ?></a></h6>
                                        <ul>
                                            <li>by <span><?php echo  get_the_author() ?></span></li>
                                            <li><?php echo  get_the_date('M d, Y') ?></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>

            <?php } ?>
            <div class="col-lg-12 text-center">
                <div class="pagination__option">
                    <?php echo paginate_links([
                        'prev_text' => '<i class="fa fa-angle-left"></i>',
                        'next_text' => '<i class="fa fa-angle-right"></i>',
                        'type'      => 'plain',
                    ]) ?>
                </div>
            </div>
        </div>
</section>
<!-- Blog Section End -->

<?php get_footer('footer.php') ?>