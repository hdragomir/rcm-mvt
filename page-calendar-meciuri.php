<?php the_post();  get_header(); ?>

<div id="wrap" class="cc">
    <article class="full clearfix">
        <h1><?php the_title(); ?></h1>


        <?php if($content = get_the_content()): ?>
        <div class="post-content"><?php echo $content; ?></div>
        <div class="space">&nbsp;</div>
        <?php endif; ?>



        <div class="eventslist article-list clearfix">

            <?php $evs = new WP_Query('post_type=matches&posts_per_page=-1&post_status=future&order=asc');
            $i = 0;
            foreach($evs->get_posts() as $match): $evs->the_post();

                $stadium = rcm_get_match_stadium( $match->ID );
                $stadium_link = rcm_get_match_stadium_link( $match->ID );
                $stage = get_post_meta($match->ID, 'etapa', true);

                $league = @array_shift( get_the_terms($match->ID, 'league') );

                $preheader = $league->name . ( $stage ?  " / Etapa $stage" : '');


            if($i && ! ( $i % 3 )): ?>
            </div><div class="space"></div><div class="eventslist article-list clearfix">
            <?php endif;
            $i++;

            ?><article>

                <div class="preahead"><?php echo $preheader; ?></div>

                <h2><?php the_title(); ?></h2>

                <div class="meta"><?php echo apply_filters('the_date', date('d F Y, \O\r\a H:i', strtotime($match->post_date))); ?><br>

                <?php if($stadium_link): ?>
                    <a target=_blank href="<?php echo $stadium_link; ?>"><?php echo $stadium; ?></a>
                <?php else: ?>
                    <?php echo $stadium; ?>
                <?php endif; ?>

                <?php if(rcm_has_facebook_event()): ?>
                    <a class=to-facebook rel=external href="<?php rcm_the_facebook_event_link(); ?>">vezi pe Facebook</a>
                <?php endif; ?>

                <?php
                if($tv_show_id = get_post_meta($match->ID, 'transmisiune_tv', true)):
                    if(is_numeric($tv_show_id)):
                    $tv_show = get_post($tv_show_id);
                        if($tv_show):
                            $program = array_shift( get_the_terms($tv_show->ID, 'tv_program') ); ?>

                            <br /> Transmis pe <?php echo rcm_term_name($program); ?>


                    <?php
                        endif;


                    else: ?>

                    Transmis pe <?php echo $tv_show_id; ?>

                    <?php

                    endif;
                endif; ?>


            </article><?php endforeach; ?>


        </div>


    </article>
</div>


<?php get_footer(); ?>
