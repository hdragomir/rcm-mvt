<?php the_post(); get_header(); ?>


<div id="wrap" class=cc>

    <article class="g_100 clearfix">

        <a href="<?php to_page('echipa'); ?>" class="preh1 right">Vezi toți jucătorii &raquo; </a>

        <h1><?php the_title(); ?></h1>

        <div class="g_50 post-content">
            <h2><?php echo get_post_meta(get_the_ID(), 'post', true); ?></h2>
                <?php the_content(); ?>
        </div>

        <div class="g_50">
            <?php the_post_thumbnail('player-thumbnail'); ?>
        </div>

        <div class="space"></div>



    </article>




</div>

<?php get_footer(); ?>
