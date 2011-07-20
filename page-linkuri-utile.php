<?php the_post();  get_header(); ?>

<div id="wrap" class="cc">
    <article class="full clearfix">
        <h1><?php the_title(); ?></h1>


       <?php if($content = get_the_content()): ?>
        <div class="post-content"><?php echo $content; ?></div>
        <div class="space">&nbsp;</div>
        <?php endif; ?>

        <ul class="linker">
            <?php wp_list_bookmarks(array(
                'category_name' => 'Linkuri Utile',
                'title_li' => null,
                'categorize' => 0
            )); ?>
        </ul>

    </article>
</div>


<?php get_footer(); ?>
