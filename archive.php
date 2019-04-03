<?php get_template_part('templates/page', 'header'); 
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
$cat = get_category( get_query_var( 'cat' ) );
$custom_args = array(
	  'post_type' => 'post',
	  'category_name' => $cat->slug,
      'posts_per_page' => 15,
      'paged' => $paged
    );

echo $cat->ID;
?>
<div class="container blog-top">
	<div class="row">
		<div class="col-sm-12 col-lg-9">
		  <?php
		  $how_many_last_posts = intval(get_post_meta($post->ID, 'archived-posts-no', true));
		  if($how_many_last_posts > 200 || $how_many_last_posts < 2) $how_many_last_posts = 15;

		  $my_query = new WP_Query($custom_args);
		  if($my_query->have_posts()) {

		    $counter = 1;
		    while($my_query->have_posts() && $counter <= $how_many_last_posts) {
		      $my_query->the_post();

		      if($counter ==1) {
		      ?>
		      <div class="row">
		      	<div class="col-sm-12">
		      		<img src="<?php the_post_thumbnail_url('w800'); ?>" class="img-fluid clearfix feature-blog-img" />
		      		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		      	</div>
		      	<div class="col-sm-12 archive-meta">
		      		<span>By <?php the_author(); ?></span><span><?php the_date(); ?></span><span><?php the_category(', '); ?></span><span><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></span><span><?php if ( function_exists( 'time_to_read' ) ) { echo time_to_read( false ); } ?></span>
		      	</div>
		      	<div class="col-sm-12 archive-excerpt">
		      	<?php the_excerpt(); ?>
		      	</div>
		      </div>
		      <div class="row">
		      <?php
		      // end counter == 1
		      } elseif ($counter < 16) {

		      ?>
		      
		      	<div class="col-sm-6 pl-0">
			      	<div class="col-sm-12">
			      		<img src="<?php the_post_thumbnail_url('w800'); ?>" class="img-fluid clearfix feature-blog-img" />
			      		<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			      	</div>
			      	<div class="col-sm-12 archive-meta">
			      		<span>By <?php the_author(); ?></span><span><?php the_date(); ?></span><span><?php the_category(', '); ?></span><span><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></span><span><?php if ( function_exists( 'time_to_read' ) ) { echo time_to_read( false ); } ?></span>
			      	</div>
			      	<div class="col-sm-12 archive-excerpt">
			      	<?php the_excerpt(); ?>
			      	</div>
			    </div>
		      <?php 
		      } 

		    $counter++;	// increase counter
		    } // end loop

		    wp_reset_postdata();
		  }
		  
		  echo "</div>";

	      if (function_exists(custom_pagination())) {
	        custom_pagination(15,"",$paged);
	      }
	    ?>
		</div>
		<div class="col-sm-0 col-lg-3">
		  <?php /* Enabling the widget areas for the archive page. */
			if(is_active_sidebar('archives-right-top')) dynamic_sidebar('archives-right-top');
			if(is_active_sidebar('archives-right-bottom')) dynamic_sidebar('archives-right-bottom'); ?>
			<div style="clear: both; margin-bottom: 30px;"></div><!-- clears the floating -->
		</div>
	</div>
</div>
