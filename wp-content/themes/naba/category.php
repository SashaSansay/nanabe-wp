<?php
get_header('main');
global $wp_query;
$billboard = $wp_query->posts;
?>
<section class="billboard">
    <?php
    include('billboard.items.php');
    ?>
</section>
<?php
get_footer('main');
?>
