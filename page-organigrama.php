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
        <?php endif; ?>

        <div class="space">&nbsp;</div>

        <?php
        $posts = new WP_Query('post_type=staff&posts_per_page=-1&meta_key=post&staff_category=consiliul de conducere');

        if($posts->have_posts()): ?>

        <div class="player-list clearfix">
            <h1>Consiliul de conducere</h1>
            <?php while($posts->have_posts()): $posts->the_post(); ?>
            <div class="player">
                <a>
                    <?php the_post_thumbnail('player-thumbnail'); ?>
                    <b><span class="name"><?php the_title(); ?></span>
                        <span class="position"><?php echo get_post_meta(get_the_ID(), 'post', true); ?></span></b>
                </a>
            </div>

            <?php endwhile; wp_reset_postdata(); wp_reset_query(); ?>

        </div>
        <?php  endif; ?>

        <div class="space">&nbsp;</div>

        <?php
        $posts = new WP_Query('post_type=staff&posts_per_page=-1&meta_key=post&staff_category=staff tehnic');

        if($posts->have_posts()): ?>

        <div class="player-list clearfix">
            <h1>Staff tehnic</h1>
            <?php while($posts->have_posts()): $posts->the_post(); ?>
            <div class="player">
                <a>
                    <?php the_post_thumbnail('player-thumbnail'); ?>
                    <b><span class="name"><?php the_title(); ?></span>
                        <span class="position"><?php echo get_post_meta(get_the_ID(), 'post', true); ?></span></b>
                </a>
            </div>

            <?php endwhile; wp_reset_postdata(); wp_reset_query(); ?>

        </div>
        <?php  endif; ?>

    </article>
</div>


<?php get_footer(); ?>
