<?php get_header(); ?>

<div id="wrap" class="cc">

    <section class="recent clearfix">

        <a href="<?php to_page('stiri'); ?>" class="right preh1">Vezi arhiva de Stiri &raquo;</a>
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

</div>


<?php get_footer(); ?>
