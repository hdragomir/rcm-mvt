<?php the_post();  get_header(); ?>

<div id="wrap" class="cc">
    <article class="full clearfix">
        <h1><?php the_title(); ?></h1>


        <div class="post-content"><?php the_content(); ?></div>

        <ul class="linker">
            <?php wp_list_bookmarks(array(
                'category_name' => 'Aparitii in Presa',
                'title_li' => null,
                'categorize' => 0
            )); ?>
        </ul>

    </article>
</div>


<?php get_footer(); ?>
