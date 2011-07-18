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


        <?php

        $shows = new WP_Query('post_type=tv_schedule&post_status=future&numberposts=-1');

        if($shows->have_posts()): ?>
        <div class="article-list eventslist clearfix">
            <?php foreach($shows->get_posts() as $show): ?>

            <article>

                <div class="date"><?php echo date('d F Y, \O\r\a H:i', strtotime($show->post_date)); ?></div>
                <h2>
                <?php $teams = array_combine(array(0,1), get_the_terms($show->ID, 'versus'));
                    echo rcm_term_name($teams[0]);
                    if( ! empty( $teams[1] ) ):
                        echo ' vs. ', rcm_term_name($teams[1]);
                    endif;
                ?>
                </h2>
                <div class="meta"><?php

                $program = array_shift(get_the_terms($show->ID, 'tv_program'));
                echo rcm_term_name($program);

                $online = get_post_meta($show->ID, 'vezi_online', true);
                if($online):
                    echo " &mdash;&nbsp; <a href=\"$online\" rel=external>vezi online</a>";
                endif;


                ?></div>

            </article>



            <?php endforeach; ?>
        </div>
        <?php endif; ?>



    </article>
</div>


<?php get_footer(); ?>
