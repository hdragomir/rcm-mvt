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

        <h1>Jucatorii Echipei</h1>

        <?php foreach( array(
                             'Linia I (pilier)' => 'Linia I (pilier)',
                             'Linia I (taloneur)' => 'Linia I (taloneur)',
                             'Linia II' => 'Linia II',
                             'Linia III (flanker)' => 'Linia III (flanker)',
                             'Linia III (Nr. 8)' => 'Linia III (Nr. 8)',
                             'Mijlocas la gramada' => 'Mijlocaș la grămadă',
                             'Mijlocas la deschidere' => 'Mijlocaș la deschidere',
                             'Aripă 3/4' => 'Aripă 3/4',
                             'Centru 3/4' => 'Centru 3/4',
                             'Fundaș' => 'Fundaș'
                             ) as $_post => $_post_nicename):

        $posts = new WP_Query('post_type=player&posts_per_page=-1&meta_key=post&meta_value=' . $_post);

        if($posts->have_posts()): ?>

        <div class="player-list clearfix">
            <h1><?php echo $_post_nicename; ?></h1>
            <?php while($posts->have_posts()): $posts->the_post(); ?>
            <div class="player">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('player-thumbnail'); ?>
                    <b><span class="name" style="border: none;"><?php the_title(); ?></span>
                        <span class="position" style="display: none"><?php echo $_post_nicename; ?></span></b>
                </a>
            </div>

            <?php endwhile; wp_reset_postdata(); wp_reset_query(); ?>





        </div>
        <?php  endif; endforeach; ?>

    </article>
</div>


<?php get_footer(); ?>
