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

        <div class="article-list clearfix">
            <?php $news = new WP_Query('numberposts=-1&cat=-' . PRESS_RELEASE_CATEGORY);
            if($news->have_posts()):
                foreach($news->get_posts() as $news_item): setup_postdata($news_item); $news->the_post();
            ?>
            <article>

                <div class="date"><?php echo get_the_date(); ?></div>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="post-text"><?php the_excerpt(); ?></div>
                <a href="<?php the_permalink(); ?>" class="read-news-cta ir">Citeste Stirea</a>

            </article>

            <?php
                endforeach;
            endif; ?>

        </div>

    </article>
</div>


<?php get_footer(); ?>
