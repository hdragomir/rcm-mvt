<?php the_post();  get_header(); ?>

<div id="wrap" class="cc">
    <article class="full clearfix">
        <h1><?php the_title(); ?></h1>


        <?php if($content = get_the_content()): ?>
        <div class="post-content"><?php echo $content; ?></div>
        <div class="space">&nbsp;</div>
        <?php endif; ?>


        <div class="panes full fat">
        <?php
        
        
        $match_query = new WP_Query('post_type=matches&posts_per_page=-1&order=desc&meta_key=scor' );
        $matches = $match_query->get_posts();
        $leagues = array_reverse(get_terms('league'));
        global $league;
        foreach($leagues as $league ):
            $reduced = array_filter($matches, 'reduce_by_global_league');
            if(! $reduced) continue;
            ?>

            <div class="pane collapse" style="margin-left: 0;">
                <div class="top">
                    <h3><?php echo $league->description? $league->description : $league->name; ?></h3>
                </div>

                <div class="collapse-me">
                <table>
                    <tr>
                        <th class="step">Etapa</th>
                        <th class=when></th>
                        <th class=host>Gazde/Oaspeți</th>
                        <th class=where>Stadionul</th>
                        <th class=trt>Tur-Retur</th>
                        <th class=score>Scor</th>
                    </tr>
            <?php
                
                foreach($reduced as $nth => $match):

                    $us = 'RCM Universitatea de Vest Timisoara';
                    $team = array_shift(get_the_terms($match->ID, 'versus'));
                    $them = $team->description ? $team->description : $team->name;
                    $at_home = ! get_post_meta($match->ID, 'deplasare', true);
                    $stadium = rcm_get_match_stadium( $match->ID );
                    $stadium_link = rcm_get_match_stadium_link( $match->ID );

                    $news_ID = get_post_meta($match->ID, 'id_stire', true);

                ?>
                <tr>
                        <td class="step"><?php echo get_post_meta($match->ID, 'etapa', true); ?></td>
                        <td class=when><?php echo apply_filters('the_date', date('d F Y, \O\r\a H:i', strtotime($match->post_date))); ?></td>
                        <td class=teams><?php echo $at_home? $us : $them; ?> <br> <?php echo $at_home? $them : $us;

                        if($news_ID):
                            ?><br>
                            <a href="<?php echo get_permalink($news_ID); ?>">vezi stirea</a>
                        <?php endif; ?></td>
                        <td class=where><?php if($stadium_link): ?>
                            <a target=_blank href="<?php echo $stadium_link; ?>"><?php echo $stadium; ?></a>
                        <?php else: ?>
                            <?php echo $stadium; ?>
                        <?php endif; ?>
                        </td>
                        <td class=trt><?php echo get_post_meta($match->ID, 'tur_retur', true); ?></td>
                        <td class=score><?php echo get_post_meta($match->ID, 'scor', true);
                        $at_break = get_post_meta($match->ID, 'scor_pauza', true);
                        if($at_break):
                        ?><div class="at-break">[<?php echo $at_break; ?>]</div>
                        <?php endif; ?>
                        </td>

                </tr>

                <?php endforeach; ?>
                </table>
                </div>
            </div>

        <?php endforeach; ?>
        </div>





    </article>
</div>


<?php get_footer(); ?>
