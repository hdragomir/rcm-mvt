<?php get_header(); ?>

<div id="wrap" class="cc">


    <p id="greeter">

        Vă urăm bun venit pe siteul oficial al Clubului Municipal de Rugby MVT „Universitatea de Vest” Timişoara. Acest site este dedicat tuturor celor implicaţi sau interesaţi de sportul cu balonul oval.<br>
        Pentru că rugby înseamnă demnitate si onoare, ne mândrim să vă avem aproape la bine si la greu. Aici nimeni nu se da rodund!
    </p>


    <section class="recent clearfix">

        <a href="<?php to_page('media/stiri'); ?>" class="right preh1">Vezi arhiva de Stiri &raquo;</a>
        <h1>Stiri / Evenimente / Noutati</h1>

        <div class="article-list clearfix">
            <?php $news = new WP_Query('numberposts=3');
            if($news->have_posts()):
                foreach($news->get_posts() as $news_item): setup_postdata($news_item); $news->the_post();
            ?>
            <article>

                <div class="date"><?php the_date(); ?></div>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-content"><?php the_excerpt(); ?></div>
                <a href="<?php the_permalink(); ?>" class="read-news-cta ir">Citeste Stirea</a>



            </article>

            <?php
                endforeach;
            endif; ?>

        </div>



    </section>


    <section class="panes clearfix">


        <div class="pane" id=results>

            <div class="top">
                <h3>Rezultate</h3>
            </div>
            <ul><?php $match_query = new WP_Query('post_type=matches&numberposts=4&order=desc&meta_key=scor');
                $i = 0;
                foreach($match_query->get_posts() as $match): if($i == 4) break; ++$i; ?>

                <?php $us = 'RCM Universitatea de Vest Timisoara';
                    $them = array_shift(get_the_terms($match->ID, 'versus'))->name;
                    $at_home = ! get_post_meta($match->ID, 'deplasare', true);
                ?>
                <li>
                    <span class="score right"><?php echo get_post_meta($match->ID, 'scor', true); ?></span>
                    <span class="host"><?php echo $at_home ? $us : $them; ?></span>
                    <span class="guest"><?php echo $at_home ? $them : $us; ?></span>
                </li>

                <?php endforeach; ?>

            </ul>
            <div class="bottom">
                <a href="<?php to_page('echipa/rezultate'); ?>" class="view-all-results-cta ir">Vezi Toate Rezultatele</a>
            </div>


        </div>
        <div class="pane" id=rankings>
            <?php $league = get_term_by('name', 'SuperLiga CEC', 'league'); ?>
            <div class="top">
                <h3>Clasament</h3>
                <p><?php echo $league->description? $league->description : $league->name; ?></p>
            </div>
            <ol><?php

                $match_query = new WP_Query('post_type=rankings&numberposts=8&order=desc&meta_key=puncte&orderby=meta_value&league=' . $league->term_ID );
                foreach($match_query->get_posts() as $nth => $rank): ?>

                <?php $team = array_shift(get_the_terms($rank->ID, 'versus'));
                    $is_us = stristr($team->name, 'timi');
                ?>
                <li<?php if($is_us): ?> class=us <?php endif;?>>

                    <span class="score right"><?php echo get_post_meta($rank->ID, 'puncte', true); ?></span>
                    <span class="nth"><?php echo $nth + 1; ?>.</span>
                    <span class="host"><?php echo $team->description ? $team->description : $team->name; ?></span>
                </li>

                <?php endforeach; ?>

            </0l>
            <div class="bottom">
                <a href="<?php to_page('echipa/clasament'); ?>" class="view-all-rankings-cta ir">Vezi Toate Clasamentele</a>
            </div>

        </div>


    </section>


</div>


<?php get_footer(); ?>
