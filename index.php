<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php wp_title('|', 1, 'right'); bloginfo('site_title'); ?></title>
	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?v=2">

	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-1.7.min.js"></script>
</head>
<body <?php body_class(); ?>>

<header>
    <div class="cc">
        <a class=ir id=logo href="<?php bloginfo('home'); ?>"><?php bloginfo('site_title'); ?></a>
        <?php wp_nav_menu(array('menu' => 'nav', 'theme_location' => 'Navigation', 'depth' => 2, 'container' => 'nav', 'menu_class' => 'dd', 'menu_id' => 'topnav', 'walker' => new extended_walker())); ?>
    </div>
</header>
<section id="next-match-push">
    <div class="cc">
        <div class="title">Următorul Meci:</div>
        <article>
            <div class="who">
                <span class="us">RCM Universitatea de Vest Timisoara</span>
                <span class="vs">vs.</span>
                <span class="them">CSM Bucuresti</span>
            </div>
            <div class="meta">h3llo <span class="slash">/</span> where</div>

        </article>
        <a href="<?php to_page('calendar-meciuri'); ?>" class="cta">Vezi Calendarul de Meciuri &raquo;</a>
    </div>
</section>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
	<script src="js/script.js"></script>
	<!--[if lt IE 7 ]>
	<script src="js/libs/dd_belatedpng.js"></script>
	<script> DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
</body>
</html>
