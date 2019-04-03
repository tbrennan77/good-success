<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer
  'lib/wp_bootstrap_navwalker.php' // Bootstrap nav added
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


add_theme_support('html5', array('search-form'));

function theme_theme_customizer($wp_customize) {

  $wp_customize->add_section( 'theme_logo_section' , array(
      'title'       => __( 'Logos', 'theme' ),
      'priority'    => 30,
      'description' => 'Upload logos for this theme',
  ) );

  $wp_customize->add_setting( 'theme_logo', array(
    'default' => get_bloginfo('template_directory') . '/images/default-logo.png',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'theme_logo', array(
  
    'label'    => __( 'Main logo', 'theme' ),
    'section'  => 'theme_logo_section',
    'settings' => 'theme_logo',
  ) ) );  

  $wp_customize->add_setting( 'footer_logo', array(
    'default' => get_bloginfo('template_directory') . '/images/default-logo.png',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
  
    'label'    => __( 'Footer logo', 'theme' ),
    'section'  => 'theme_logo_section',
    'settings' => 'footer_logo',
  ) ) );  

  $wp_customize->add_setting( 'mobile_logo', array(
    'default' => get_bloginfo('template_directory') . '/images/default-logo.png',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mobile_logo', array(
  
    'label'    => __( 'Mobile logo', 'theme' ),
    'section'  => 'theme_logo_section',
    'settings' => 'mobile_logo',
  ) ) );  


}
add_action('customize_register', 'theme_theme_customizer');


function homepage_featured_events() {

$args = array(
 'post_type' => 'tribe_events',
 'posts_per_page' => '2',
 'order'=>'ASC'
);
  
  $output="";

  // the query
  $query = new WP_Query($args);

  // The Loop
  if ( $query->have_posts() ) {
    while ( $query->have_posts() ) : $query->the_post() ;
        $start_date = tribe_get_start_date($query->ID, false);
        $output .= "<div class='col-sm-12 col-lg-6'><div class='next-event'><span>".the_title('','',false)."<br />".$start_date."</span><br /><a href=".tribe_get_event_meta( get_the_ID(), '_EventURL', true )."><button class='btn btn-outline-primary hvr-grow'>Sign Up Today</button></a></div></div>";
    endwhile;
  } 

  return "<div class='container mx-auto'><div class='row'>".$output."</div></div>";
}


add_shortcode('homepage_event', 'homepage_featured_events');


/**
 * Returns an estimated reading time in a string
 * idea from @link http://briancray.com/posts/estimated-reading-time-web-design/
 * @param  string $content the content to be read
 * @return string          estimated read time eg. 1 minute, 30 seconds
 */
function time_to_read( $content = false ) {
 
    if ( is_single () ) {
        if ( !$content ) { $content = get_the_content(); $add = false; } else { $add = true; }
 
      $time = str_word_count( strip_tags( $content ) ) / 300;
        if ( $time == 0 ) { $time = 0.1; } // If there is no content, report < 1 minute
      $rounded = ceil( $time );
        $output = '' . ( $time<1?'<':'' ) . $rounded . ' min.' . ( $rounded>1?'':'' ) . ' read';
 
        if ( $add ) { $content = $output . $content; } else { $content = $output; }
 
    }
    return $content;
}


// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
       global $post;
  return '<button class="btn btn-primary hvr-grow clearfix"><a class="moretag" href="'. get_permalink($post->ID) . '"> Read the full article...</a></button>';
}
add_filter('excerpt_more', 'new_excerpt_more');




function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination text-center mb-4'>";
      //echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}


/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 **/
function custom_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search" />
    <button type="submit" id="searchsubmit" />
           <span class="icon"><i class="fa fa-search"></i></span>   
      </button>
    </div>
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'custom_search_form' );

