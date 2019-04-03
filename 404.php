<?php get_template_part('templates/page', 'header'); ?>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div class="alert alert-warning">
			  <?php _e('Sorry, but the page you were trying to view does not exist. Try a new search below.', 'sage'); ?>
			</div>
		</div>
		<div class="col-sm-12">
			<?php get_search_form(); ?>
		</div>
		<div class="col-sm-12">
		<p></p>
		</div>
	</div>
</div>

