<?php get_template_part('templates/page', 'header'); 
      while (have_posts()) : the_post(); ?>
<div class="container blog-top">
  <div class="row">
    <div class="col-sm-12 col-lg-9">
        <div class="row">
          <div class="col-sm-12">
            <img src="<?php the_post_thumbnail_url('w800'); ?>" class="img-fluid clearfix feature-blog-img" />
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
          </div>
          <div class="col-sm-12 archive-meta">
            <span>By <?php the_author(); ?></span><span><?php the_date(); ?></span><span><?php the_category(', '); ?></span><span><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?></span><span><?php if ( function_exists( 'time_to_read' ) ) { echo time_to_read( false ); } ?></span>
          </div>
          <div class="col-sm-12 archive-excerpt">
          <?php the_content(); ?>
          </div>
        </div>
    </div>
    <div class="col-sm-0 col-lg-3">
      <?php /* Enabling the widget areas for the archive page. */
      if(is_active_sidebar('archives-right-top')) dynamic_sidebar('archives-right-top');
      if(is_active_sidebar('archives-right-bottom')) dynamic_sidebar('archives-right-bottom'); ?>
      <div style="clear: both; margin-bottom: 30px;"></div><!-- clears the floating -->
    </div>
  </div>
</div>
<?php endwhile; ?>
