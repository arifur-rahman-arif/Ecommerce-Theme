<?php

namespace OS\Includes\Classes;

class Comment_Walker_Class extends \Walker_Comment {
    private $child_comments;


    protected function html5_comment($comment, $depth, $args) {
        $tag = ('div' === $args['style']) ? 'div' : 'li';

        $commenter          = wp_get_current_commenter();
        $show_pending_links = !empty($commenter['comment_author']);

        if ($commenter['comment_author_email']) {
            $moderation_note = __('Your comment is awaiting moderation.');
        } else {
            $moderation_note = __('Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.');
        }
?>
        <div id="comment-<?php comment_ID(); ?>" class="<?php $this->define_comment_class($comment->comment_parent) ?>">

            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <div class="blog__comment__item__pic">
                    <?php
                    if (0 != $args['avatar_size']) {
                        echo get_avatar($comment, $args['avatar_size']);
                    }
                    ?>
                </div>
                <div class="blog__comment__item__text">
                    <?php
                    $comment_author = get_comment_author_link($comment);

                    if ('0' == $comment->comment_approved && !$show_pending_links) {
                        $comment_author = get_comment_author($comment);
                    }

                    printf(
                        sprintf('<h6 class="fn">%s</h6>', $comment_author)
                    );
                    ?>
                    <?php comment_text(); ?>
                    <ul>
                        <li><i class="fa fa-clock-o"></i> <?php echo get_comment_date('M d, Y') ?></li>
                        <?php
                        if ('1' == $comment->comment_approved || $show_pending_links) {
                            comment_reply_link(
                                array_merge(
                                    $args,
                                    array(
                                        'add_below' => 'div-comment',
                                        'depth'     => $depth,
                                        'max_depth' => $args['max_depth'],
                                        'before'    => '<li class="reply"><i class="fa fa-share"></i>',
                                        'after'     => '</li>',
                                    )
                                )
                            );
                        }
                        ?>
                    </ul>
                </div>
            </article><!-- .comment-body -->
    <?php
    }
    public function define_comment_class($comment_parent) {
        if ($comment_parent) {
            echo 'blog__comment__item blog__comment__item--reply';
        } else {
            echo 'blog__comment__item';
        }
    }
}
