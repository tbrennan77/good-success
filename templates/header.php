<div class="container-fluid login-slider-container">
 <div class="row">
  <div class="collapse col-sm-12" id="loginSlider">
    <div class="container">
     <div class="row">
      <div class="col-sm-0 col-lg-4">
          <?php dynamic_sidebar('member-panel-left'); ?> 
      </div>
      <div class="col-sm-6 col-lg-4">
          <?php dynamic_sidebar('member-panel-center'); ?> 
      </div>
      <div class="col-sm-6 col-lg-4 pb-4 last">
        <section class="widget widget_text">
          <div class="textwidget">
            <h4>Already a Member?</h4>
            <?php wp_login_form(); ?>
          </div>
        </section>
      </div>
     </div>
   </div>
  </div>
 </div>
</div>
<div class="container-fluid top-bar">
  <div class="row">
    <div class="container">
      <div class="row justify-content-sm-center">
        <div class="col-xs-12 col-sm-8">
          <?php dynamic_sidebar('top-bar'); ?> 
        </div>
        <div class="col-xs-12 col-sm-4 justify-content-sm-center">
          <a class="float-lg-right member-access-link" data-toggle="collapse" href="#loginSlider" role="button" aria-expanded="false" aria-controls="loginSlider">
            Member Access
          </a>
          <a class="float-lg-right eternal-access-link" href="/eternal-success/">
            Eternal Success
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<header class="banner">
  <div class="container menu-bar">
    <div class="row">
        <div class="col">
          <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <a class="navbar-brand" href="#">
              <?php
                    if ( get_theme_mod('theme_logo') ) :
                      echo '<img src="' . esc_url( get_theme_mod('theme_logo') ) . '" class="">';
                    else:
                      echo get_bloginfo('name');
                    endif;
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
                <?php
                  if (has_nav_menu('primary_navigation')) :
                    wp_nav_menu([ 'menu' => 'primary_navigation',
                      'theme_location' => 'primary_navigation',
                      'container_class' => 'collapse navbar-collapse',
                      'container_id' => 'navbarNav',
                      'menu_id' => false,
                      'menu_class' => 'navbar-nav',
                      'depth' => 2,
                      'fallback_cb' => 'bs4navwalker::fallback',
                      'walker' => new bs4navwalker()
                      ]);
                  endif;
                  
                  //get_template_part('templates/search');
                   ?>
          </nav>
        </div>
    </div>
  </div>
</header>


