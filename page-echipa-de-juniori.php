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
        <div class="post-content"><?php echo $content; ?></div>
        <div class="space">&nbsp;</div>

        <h1>Jucatorii Echipei</h1>
        <?php endif; ?>



        <div class="player-list clearfix">
            <?php
            $posts = new WP_Query('post_type=junior&posts_per_page=-1&meta_key=pozitie');
            while($posts->have_posts()): $posts->the_post(); ?>
            <div class="player">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('player-thumbnail'); ?>
                    <b><span class="name"><?php the_title(); ?></span>
                        <span class="position"><?php echo get_post_meta(get_the_ID(), 'pozitie', true); ?></span></b>
                </a>
            </div>

            <?php endwhile; wp_reset_postdata(); wp_reset_query(); ?>



        </div>

    </article>
</div>


<?php get_footer(); ?>
