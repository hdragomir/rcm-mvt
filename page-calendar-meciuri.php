<?php the_post();  get_header(); ?>

<div id="wrap" class="cc">
    <article class="full clearfix">
        <h1><?php the_title(); ?></h1>


        <?php if($content = get_the_content()): ?>
        <div class="post-content"><?php echo $content; ?></div>
        <div class="space">&nbsp;</div>
        <?php endif; ?>



        <div class="eventslist article-list clearfix">

            <?php $evs = new WP_Query('post_type=matches&posts_per_page=-1&post_status=future');
            foreach($evs->get_posts() as $match): $evs->the_post(); ?><article>
                <h2><?php the_title(); ?></h2>

                <div class="meta"><?php echo date('d F Y, \O\r\a H:i', strtotime($match->post_date)); ?><br>

                <?php echo get_post_meta($match->ID, 'unde', true); ?></div>

                <?php if(rcm_has_facebook_event()): ?>
                    <a class=to-facebook rel=external href="<?php rcm_the_facebook_event_link(); ?>">vezi pe Facebook</a>
                <?php endif; ?>

                <?php if($tv_show_id = get_post_meta($match->ID, 'transmisiune_tv', true)):
                    if(is_numeric($tv_show_id)):
                    $tv_show = get_post($tv_show_id);
                    if($tv_show):
                        $program = array_shift( get_the_terms($tv_show->ID, 'tv_program') ); ?>

                        Transmis pe <?php echo rcm_term_name($program); ?>


                <?php
                    else: ;
                    endif;

                    endif;
                endif; ?>


            </article><?php endforeach; ?>


        </div>


    </article>
</div>


<?php get_footer(); ?>
