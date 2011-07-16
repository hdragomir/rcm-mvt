<?php the_post();  get_header(); ?>

<div id="wrap" class="cc">
    <article class="full clearfix">
        <div class="preh1 date"><?php the_date(); ?></div>
        <h1><?php the_title(); ?></h1>


        <div class="post-content"><?php the_content(); ?></div>

    </article>
</div>


<?php get_footer(); ?>
