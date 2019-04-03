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
          <a class="float-lg-right member-access-link collapsed" data-toggle="collapse" href="#loginSlider" aria-expanded="false" aria-controls="collapseExample">
            <span>Member Access</span>
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
  <div class="container-fluid">
    <div class="row">
      <div class="container min-width-300">
        <div class="row">
          <nav class="navbar navbar-toggleable-md navbar-light sticky-top pr-0 pl-0">
            <button class="navbar-toggler navbar-toggler-right float-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            
            <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
              <div class="hidden-xs-down float-left">
                <?php
                    if ( get_theme_mod('theme_logo') ) :
                      echo '<img src="' . esc_url( get_theme_mod('theme_logo') ) . '" class="">';
                    else:
                      echo get_bloginfo('name');
                    endif;
                ?>
              </div>
              <div class="hidden-sm-up float-left">
                <?php
                    if ( get_theme_mod('mobile_logo') ) :
                      echo '<img src="' . esc_url( get_theme_mod('mobile_logo') ) . '" class="">';
                    else:
                      echo get_bloginfo('name');
                    endif;
                ?>
              </div>
            </a>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <?php
                if (has_nav_menu('primary_navigation')) :
                  wp_nav_menu(['theme_location' => 'primary_navigation', 
                    'menu_class' => 'navbar-nav justify-content-center float-right', 
                    'fallback_cb'=> 'wp_bootstrap_navwalker::fallback',
                    'walker'     => new wp_bootstrap_navwalker()]);
                endif;
              ?>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>

