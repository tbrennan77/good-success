<?php if ( is_bbpress() ) : ?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<?php the_content(); ?>
		</div>
	</div>
</div>
<?php else : 
      the_content(); 
      ?>
      <div class="container">
            <div class="row">
                  <div class="col-sm-12 home-testimonials">
      <?php
      if(is_front_page()) {
            if(is_active_sidebar('home-testimonials')) dynamic_sidebar('home-testimonials');
      }
      endif; ?>
                  </div>
            </div>
      </div>
      <div class="container-fluid">
            <div class="row">
                  <div class="col-sm-12 page-footer-call">
                        <?php
                        if(is_active_sidebar('page-footer')) dynamic_sidebar('page-footer');
                        ?>
                  </div>
            </div>
      </div>
      <?php
            wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); 

            // Get the Page ID
            global $wp_query;
            $page_id = $wp_query->get_queried_object_id();

            // Get the custom field for desktop image url
            $bg_image_id = get_field('default_desktop_background', $page_id);
            $bg_image = wp_get_attachment_image_src( $bg_image_id, 'full', false );

            // Get the custom field for mobile image url
            $mobile_image_id = get_field('default_mobile_background', $page_id);
            $mobile_image = wp_get_attachment_image_src( $mobile_image_id, 'full', false );

      ?>
      <style type="text/css">
      /* Small devices (phone, 300px and up) */
      @media (min-width: 300px) { 
            .default_page_header {
                  background-image: url(<?php echo $mobile_image[0]; ?>) !important;
            }
      }
      /* Small devices (phone, 992px and up) */
      @media (min-width: 992px) { 
            .default_page_header {
                  background-image: url(<?php echo $bg_image[0]; ?>) !important;
            }
      }
      </style>
