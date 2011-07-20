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

        <iframe width="940" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?msa=0&amp;msid=215428306105017096073.0004a88569b35bb7c2ece&amp;hl=en&amp;doflg=ptk&amp;ie=UTF8&amp;ll=45.756296,21.184945&amp;spn=0,0&amp;output=embed"></iframe><br /><small>Vezi <a href="http://maps.google.com/maps/ms?msa=0&amp;msid=215428306105017096073.0004a88569b35bb7c2ece&amp;hl=en&amp;doflg=ptk&amp;ie=UTF8&amp;ll=45.756296,21.184945&amp;spn=0,0&amp;source=embed" style="color:#0000FF;text-align:left">Stadionul</a> pe Google Maps</small>

    </article>
</div>


<?php get_footer(); ?>
