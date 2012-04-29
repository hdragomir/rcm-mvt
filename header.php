<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js" xmlns:og="http://ogp.me/ns#"
      xmlns:fb="https://www.facebook.com/2008/fbml"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php wp_title('|', 1, 'right'); bloginfo('site_title'); ?></title>

    <meta property="og:title" content="<?php wp_title('|', 1, 'right'); bloginfo('site_title'); ?>"/>
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/logo.png"/>
    <meta property="og:site_name" content="Rugby Club Municipal Universitatea de Vest Timisoara"/>
    <meta property="fb:admins" content="100000564703312"/>

	<meta name="description" content="Pagina oficiala a clubului de rugby RCM Universitatea de Vest Timisoara">
	<meta name="author" content="Oana Barbu, Ciprian Stefanescu">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?v=1.90">

	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-1.7.min.js"></script>
</head>
<body <?php body_class(); ?>>

<header>
    <div class="cc">
        <a class=ir id=logo href="<?php bloginfo('home'); ?>"><?php bloginfo('site_title'); ?></a>
        <?php wp_nav_menu(array('menu' => 'nav', 'theme_location' => 'Navigation', 'depth' => 2, 'container' => 'nav', 'menu_class' => 'dd', 'menu_id' => 'topnav', 'walker' => new extended_walker())); ?>
    </div>


    <?php if(is_home()): ?>

    <div id="homepage-slider">
        <?php foreach( get_header_images_hash() as $slide ):
            if( $slide['image_src'][1] >= RCM_HEADER_SLIDE_WIDTH - 150 &&
                $slide['image_src'][2] >= RCM_HEADER_SLIDE_HEIGHT - 50 ):
        ?>
        <div class="slide">
            <img src="<?php echo $slide['image_src'][0]; ?>" title="<?php echo $slide['caption']; ?>" alt=""
            />
            <div class="text-wrap">
                <div class="text"><?php echo $slide['caption']; ?></div>
            </div>
        </div>
        <?php 
            endif;
        endforeach; ?>
    </div>

    <?php endif; ?>


</header>

<?php $match_query = new WP_Query('post_status=future&post_type=matches&numberposts=1&order=asc');
if($match_query->have_posts()):
    $match = array_shift($match_query->get_posts());
?>

<section id="next-match-push">
    <div class="cc">
        <div class="title">Următorul meci:</div>

        <article>
                <?php
                    $us = 'RCM Universitatea de Vest Timisoara';
                    $them = array_shift(get_the_terms($match->ID, 'versus'))->name;
                    $at_home = ! get_post_meta($match->ID, 'deplasare', true);
                    $stadium = rcm_get_match_stadium( $match->ID );
                    $stage = get_post_meta($match->ID, 'etapa', true);

                    $league = @array_shift( get_the_terms($match->ID, 'league') );

                    $preheader = $league->name . ( $stage ?  " / Etapa $stage" : '');

                ?>
            <div class="league-meta"><?php echo $preheader; ?></div>
            <div class="who">

                <span class="host"><?php echo $at_home ? $us : $them; ?></span>
                <span class="vs">vs.</span>
                <span class="guest"><?php echo $at_home ? $them : $us; ?></span>
            </div>
            <div class="meta"><?php echo apply_filters('the_date', date('d F Y, \o\r\a H:i', strtotime($match->post_date))); ?><span class="slash">/</span> <?php echo $stadium; ?>
            <?php
                if($tv_show_id = get_post_meta($match->ID, 'transmisiune_tv', true)):
                    if(is_numeric($tv_show_id)):
                    $tv_show = get_post($tv_show_id);
                        if($tv_show):
                            $program = array_shift( get_the_terms($tv_show->ID, 'tv_program') ); ?>

                            <span class="slash">/</span> <?php echo rcm_term_name($program); ?>


                    <?php
                        endif;


                    else: ?>

                    <span class="slash">/</span><?php echo $tv_show_id; ?>

                    <?php

                    endif;
                endif; ?>
            </div>

        </article>
        <a href="<?php to_page('echipa/calendar-meciuri'); ?>" class="cta">Vezi Calendarul de Meciuri &raquo;</a>
    </div>
</section>

<?php
    wp_reset_query();
endif; ?>
