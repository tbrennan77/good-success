<?php use Roots\Sage\Titles; 

  // No breadcrumb or title on the front page
  if (!is_front_page()) { ?>
  <div class="title-breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h1 class="entry-title"><?php
          
          if( is_search()) {
            echo "Search Results";
          } elseif (is_category()) { 
            echo single_cat_title()." Archives";
          } elseif (is_post_type_archive('tribe_events')) { 
            echo single_cat_title()." Upcoming Events";
          } elseif (is_singular('sfwd-lessons')) { 
            echo 'Education';
          } elseif (is_single() || is_page() || tribe_is_event()) { 
            the_title();
          } elseif (is_404()) {
            echo "Page Not Found";
          } else {
            the_title();
          }
          ?></h1>
          <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
              <?php if(function_exists('bcn_display'))
              {
                bcn_display();
                //the_breadcrumb();
              }?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          
        </div>
      </div>
    </div>
  </div>
<?php
}
?>