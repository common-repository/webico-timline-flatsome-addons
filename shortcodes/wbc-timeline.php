<?php
// [blog_posts]
function wbc_shortcode_timeline_blog($atts, $content = null, $tag) {

	extract(shortcode_atts(array(
		"_id" => 'row-'.rand(),
		'style' => '',
		'class' => '',

		// Layout
		"columns" => '4',
		"columns__sm" => '1',
		"columns__md" => '',
		'col_spacing' => '',
		"type" => 'slider', // slider, row, masonery, grid
		'width' => '',
		'grid' => '1',
		'grid_height' => '600px',
		'grid_height__md' => '500px',
		'grid_height__sm' => '400px',
		'slider_nav_style' => 'reveal',
		'slider_nav_position' => '',
		'slider_nav_color' => '',
		'slider_bullets' => 'false',
	 	'slider_arrows' => 'true',
		'auto_slide' => 'false',
		'infinitive' => 'true',
		'depth' => '',
   		'depth_hover' => '',

		// posts
		'total_posts' => '8',
		'ids' => false, // Custom IDs
		'cat' => '',
		'excerpt' => 'visible',
		'excerpt_length' => 15,
		'offset' => '',
		'order' => 'DESC',

		// Read more
		'readmore' => '',
		'readmore_color' => '',
		'readmore_style' => 'outline',
		'readmore_size' => 'small',

		// div meta
		'post_icon' => 'true',
		'comments' => 'true',
		'show_date' => 'badge', // badge, text
		'badge_style' => '',
		'show_category' => 'false',

		//Title
		'title_size' => 'large',
		'title_style' => '',

		// Box styles
		'animate' => '',
		'text_pos' => 'bottom',
	  	'text_padding' => '',
	  	'text_bg' => '',
	  	'text_size' => '',
	 	'text_color' => '',
	 	'text_hover' => '',
	 	'text_align' => 'center',
	 	'image_size' => 'medium',
	 	'image_width' => '',
	 	'image_radius' => '',
	 	'image_height' => '56%',
	    'image_hover' => '',
	    'image_hover_alt' => '',
	    'image_overlay' => '',
	    'image_depth' => '',
	    'image_depth_hover' => '',

	), $atts));

	ob_start();

  wp_enqueue_script('wbc-timeline-script', WBC_FL_Timeline_Addons_URL .'/assets/timeline.js', array('jquery'), null, true);
  wp_enqueue_style( 'wbc-timeline-style', WBC_FL_Timeline_Addons_URL . '/assets/timeline.css' );

  $tax_query = array();
  if ($cat) {
    $tax_query[] = array(
      'taxonomy'=> 'timeline_cat',
      'field' => 'ID',
      'terms' => $cat
    );
  }
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'timeline',
		'offset' => $offset,
		//'cat' => $cat,
    // 'orderby' => 'name',
    'order'   => $order,
    'tax_query' => $tax_query,
		'posts_per_page' => $total_posts,
		'ignore_sticky_posts' => true
	);

	// If custom ids
	if ( !empty( $ids ) ) {
		$ids = explode( ',', $ids );
		$ids = array_map( 'trim', $ids );

		$args = array(
			'post__in' => $ids,
      'post_type' => 'timeline',
			'numberposts' => -1,
			'orderby' => 'post__in',
			'posts_per_page' => 9999,
			'ignore_sticky_posts' => true,
		);
	}

$recentPosts = new WP_Query( $args );

?>
<div class="wbc-timeline js-wbc-timeline">
   <div class="wbc-timeline__container">
     <?php
while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>


      <div class="wbc-timeline__block js-cd-block">
         <div class="wbc-timeline__img wbc-timeline__img--picture js-cd-img">
            <?php //echo the_post_thumbnail(); ?>
         </div> <!-- wbc-timeline__img -->

         <div class="wbc-timeline__content js-cd-content">
            <h2><?php the_title() ?></h2>
            <?php echo get_the_content(); ?>
            <!-- <a href="#0" class="wbc-timeline__read-more">Read more</a> -->
            <!-- <span class="wbc-timeline__date">Jan 14</span> -->
         </div> <!-- wbc-timeline__content -->
      </div> <!-- wbc-timeline__block -->




<?php endwhile;
wp_reset_query();
?>   </div>
</div> <!-- wbc-timeline -->
<?php
$content = ob_get_contents();
ob_end_clean();
return $content;
}

add_shortcode("wbc_timeline_posts", "wbc_shortcode_timeline_blog");
