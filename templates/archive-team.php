<?php
get_header();
if( have_posts() ) {
    while( have_posts() ) {
        the_post();
    }
}
$connected = new WP_Query( array(
  'connected_type' => 'match-to-team',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );
if ( $connected->have_posts() ) :
?>
<h3>Related pages:</h3>
<ul>
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>
<?php
wp_reset_postdata();
endif;
get_sidebar();
get_footer();