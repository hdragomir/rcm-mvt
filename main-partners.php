<ul class=partner-image-list>
<?php

$partners = get_bookmarks(array(
    "orderby" => "rating",
    "order" => "DESC",
    "category_name" => "Parteneri"
));

foreach($partners as $partner):
?>
    
    <li><a href="<?php echo $partner->link_url; ?>" rel=external><img src="<?php echo str_replace('-70x70', '',  $partner->link_image ); ?>" alt="<?php echo $partner->link_name ?>" title="<?php echo $partner->link_name; ?>" /></a></li>
    

<?php endforeach; ?>
</ul>
