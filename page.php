<?php the_post();  get_header(); ?>

<div id="wrap" class="cc">
    <article class="full clearfix">
        <h1><?php the_title(); ?></h1>


        <?php if(has_post_thumbnail()): ?>
        <div class="page-thumb">
            <?php the_post_thumbnail('page-thumbnail'); ?>
        </div>
        <?php endif; ?>


        <?php if($content = get_the_content()): ?>
        <div class="post-content"><?php echo  apply_filters('the_content', $content ); ?></div>
        <div class="space">&nbsp;</div>
        <?php endif; ?>

    </article>
</div>


<?php get_footer(); ?>
