<?php
get_header('page');
while ( have_posts() ) : the_post();
?>
<section class="section--page section--page-signle">
    <div class="page__body">
        <div class="page-body__inner">
            <h4><?php the_title();?></h4>
            <?php the_content(); ?>
        </div>
    </div>
</section>
<?php
endwhile;
get_footer('page');
?>
