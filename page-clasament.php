<?php the_post();  get_header(); ?>

<div id="wrap" class="cc">
    <article class="full clearfix">
        <h1><?php the_title(); ?></h1>


        <?php if($content = get_the_content()): ?>
        <div class="post-content"><?php echo $content; ?></div>
        <div class="space">&nbsp;</div>
        <?php endif; ?>


        <div class="panes full">
        <?php $leagues = get_terms('league');

            foreach($leagues as $league ): ?>

            <div class="pane">
                <div class="top">
                    <h3><?php echo $league->description? $league->description : $league->name; ?></h3>
                </div>


                <table>
                    <tr>

                        <th class=nth></th>
                        <th class=host>Echipa</th>
                        <th class=games>J</th>
                        <th class=wins>V</th>
                        <th class=draws>E</th>
                        <th class=losses>I</th>
                        <th class=esv>Esaveraj</th>
                        <th class=bonus>Bonus</th>
                        <th class=score>Puncte</th>


                    </tr>
            <?php

            $match_query = new WP_Query('post_type=rankings&numberposts=8&order=desc&meta_key=puncte&orderby=meta_value&league=' . $league->term_ID );
                foreach($match_query->get_posts() as $nth => $rank): ?>

                <?php $team = array_shift(get_the_terms($rank->ID, 'versus'));
                    $is_us = stristr($team->name, 'timi');
                ?>
                <tr<?php if($is_us): ?> class=us <?php endif;?>>


                    <td class="nth"><?php echo $nth + 1; ?>.</td>
                    <td class="host"><?php echo $team->description ? $team->description : $team->name; ?></td>
                    <td class=games><?php echo get_post_meta($rank->ID, 'jocuri', true); ?></td>
                    <td class=wins><?php echo get_post_meta($rank->ID, 'victorii', true); ?></td>
                    <td class=draws><?php echo get_post_meta($rank->ID, 'egaluri', true); ?></td>
                    <td class=losses><?php echo get_post_meta($rank->ID, 'infrangeri', true); ?></td>
                    <td class=esv><?php echo get_post_meta($rank->ID, 'esaveraj', true); ?></td>
                    <td class=bonus><?php echo get_post_meta($rank->ID, 'bonus', true); ?></td>

                    <td class="score"><?php echo get_post_meta($rank->ID, 'puncte', true); ?></td>
                </tr>

                <?php endforeach; ?>
                </table>
            </div>

        <?php endforeach; ?>
        </div>





    </article>
</div>


<?php get_footer(); ?>
