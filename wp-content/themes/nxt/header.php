<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
  <head>
    <!-- Meta -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?php bloginfo('name'); ?></title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <?php wp_head();?>
  </head>
  <body <?php body_class()?>>
    <!--  HEADER  -->
    <header class="header-style-1">
      <div class="top-bar animate-dropdown">
        <div class="container">
          <div class="header-top-inner">
            <div class="cnt-account">
              <ul class="list-unstyled">
                <li><a href="<?php echo esc_url( home_url( '/wishlist' ) ); ?>"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                <li><a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View my car' ); ?>"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                <li><a href="<?php echo wc_get_checkout_url();?>"><i class="icon fa fa-check"></i>Checkout</a></li>
<li>

 <?php if ( is_user_logged_in() ) { ?>
  <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a>
 <?php } 
 else { ?>
  <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a>
 <?php } ?>

                </li>
              </ul>
            </div>
            <div class="cnt-block">
              <ul class="list-unstyled list-inline">
                <li class="dropdown dropdown-small">
                  <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">USD</a></li>
                    <li><a href="#">INR</a></li>
                    <li><a href="#">GBP</a></li>
                  </ul>
                </li>
                <li class="dropdown dropdown-small">
                  <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">English </span><b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">English</a></li>
                    <li><a href="#">French</a></li>
                    <li><a href="#">German</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <div class="main-header">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color: #fff;font-weight: bold;font-size: 20px">NXT</a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
              <div class="search-area">
                <form action="<?php esc_url(bloginfo( 'home' )) ?>/shop" method="GET">
                    <?php //get_product_search_form();?>
                    <input name="s" class="search-field" placeholder="Search here..." />
                    <input type="submit" class="search-button">
                </form>
              </div>
              <!-- SEARCH AREA : END -->				
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
              <!-- SHOPPING CART DROPDOWN -->
              <div class="dropdown dropdown-cart">
                <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown" >
                  <div class="items-cart-inner">
                    <div class="basket">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                    </div>
                    <div class="basket-item-count"><span class="count">
                      <?php echo WC()->cart->get_cart_contents_count(); ?>
             
                    </span></div>
                    <div class="total-price-basket">
                      <span class="lbl">cart -</span>
                      <span class="total-price">
                        <!-- <?php if (WC()->cart->get_cart_contents_total()) {
                         echo "<span class='sign'>$</span><span class='value'>".WC()->cart->get_cart_contents_total();
                        }else{ echo "empty" ;} 
                        ?> -->
                          
                        </span>
                      </span>
                    </div>
                  </div>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <div class="cart-item product-summary">
                      <?php
                        global $woocommerce;
                        $items = $woocommerce->cart->get_cart();

                            foreach($items as $item => $values) { 
                              $_product =  wc_get_product( $values['data']->get_id()); 
                              ?> 


                      <div class="row">
                        <div class="col-xs-4">
                          <div class="image">
                            <a href="<?php the_permalink();?>"><?php echo $_product->get_image();?></a>
                          </div>
                        </div>
                        <div class="col-xs-7">
                          <h3 class="name"><a href="<?php the_permalink();?>"><?php echo $_product->get_title();?></a></h3>
                          <div class="price"><?php 
                            $price = get_post_meta($values['product_id'] , '_price', true);
                            echo $price."(".$values['quantity'].")";
                          ?></div>
                        </div>
                        <div class="col-xs-1 action">
                          <?php
                              echo apply_filters( 
                                  'woocommerce_cart_item_remove_link', 
                                  sprintf( 
                                      '<a href="%s" class="remove" title="%s">&times;</a>', 
                                      esc_url( $woocommerce->cart->get_remove_url( $item ) ), 
                                      __( 'Remove this item', 'woocommerce' ) 
                                  ), 
                                  $item 
                              );
                          ?>
                        </div>
                      </div>

                                
                                
                    <?php 
                       } 
                    ?>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix cart-total">
                      <div class="pull-right">
                        <span class="text">Sub Total :</span><span class='price'>$<?php echo WC()->cart->get_cart_contents_total(); ?></span>
                      </div>
                      <div class="clearfix"></div>
                      <a href="<?php echo wc_get_checkout_url();?>" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>	
                    </div>
                  </li>
                </ul>
              </div>
              <!-- SHOPPING CART DROPDOWN : END -->				
            </div>
          </div>
        </div>
      </div>
      <!--  NAVBAR -->
      <div class="header-nav animate-dropdown">
        <div class="container">
          <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
              <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              </button>
            </div>
            <div class="nav-bg-class">
              <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                <div class="nav-outer">
              <?php 
                $defaults = array(
                  'theme_location'  => 'our-menu',
                  'menu'            => '',
                  'container'       => '',
                  'container_class' => '',
                  'container_id'    => '',
                  'menu_class'      => 'menu',
                  'menu_id'         => '',
                  'echo'            => true,
                  'fallback_cb'     => 'wp_page_menu',
                  'before'          => '',
                  'after'           => '',
                  'link_before'     => '',
                  'link_after'      => '',
                  'items_wrap'      => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
                  'depth'           => 0,
                  'walker'          => ''
                );
                wp_nav_menu( $defaults ); 
              ?> 

               <!--  <ul class="nav navbar-nav">
                    <li class="active dropdown yamm-fw">
                      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                    </li>
                    <li class="dropdown hidden-sm">
                      <a href="<?php echo esc_url( home_url( '/shop' ) ); ?>">Shop</a>
                    </li>
                    <li class="dropdown">
                      <a href="contact.html">Blog</a>
                    </li>
                    <li class="dropdown">
                      <a href="contact.html">Contact</a>
                    </li>

                  </ul> --> 
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>