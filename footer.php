
<footer>

    <div class="top cc">
        <div id="partners">
        <?php get_template_part('main-partners'); ?>
        </div>
    </div><div class="bottom">

        <div class="cc">

            <div id="fb-like">
                <iframe src="http://www.facebook.com/plugins/like.php?app_id=135611876524447&amp;href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FRugby-Club-Timisoara-Pagina-oficiala%2F224404584253969&amp;send=false&amp;layout=standard&amp;width=420&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:420px; height:24px;" allowTransparency="true"></iframe>
            </div>

            <a href="http://www.facebook.com/pages/Rugby-Club-Timisoara-Pagina-oficiala/224404584253969" rel="me external" id="to-fb" class=ir>facebook </a>


            <?php wp_nav_menu(array('menu' => 'nav', 'theme_location' => 'Navigation', 'depth' => 2, 'container' => 'nav', 'menu_class' => 'dd', 'menu_id' => 'footernav', 'walker' => new extended_walker())); ?>


            <div id="footercopy">© RCM MVT Universitatea de Vest Timisoara 2011. Toate drepturile rezervate.</div>
            <div id="footermisc"><a href="<?php to_page('contact'); ?>">Contact</a> | <a href="http://rugby-timisoara.ro/webmail" rel=external>Webmail</a></div>

        </div>


    </div>


</footer>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/script.js?v=2.1"></script>
	<!--[if lt IE 7 ]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/dd_belatedpng.js"></script>
	<script> DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->

	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21019098-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

    </script>
    
<!--[if lt IE 8 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
    <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->

</body>
</html>
