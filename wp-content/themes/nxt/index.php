<?php
  /*
  Template Name: home
  */

?>

<?php get_header(); ?>
    <!--  HEADER : END  -->
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
      <div class="container">
        <div class="row">
          <!-- SIDEBAR  -->	
          <?php get_template_part('sidebar'); ?>
          <!-- SIDEBAR : END  -->
          <!-- CONTENT -->
          <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
            <!-- SECTION – HERO -->
            <div id="hero">
              <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

                <?php
            $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 4, 'orderby' =>'date','order' => 'DESC' );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post(); global $product;
              $proId = $product->get_id();
              //$url = wp_get_attachment_url(woocommerce_get_product_thumbnail($proId)); 
              $url = get_the_post_thumbnail_url($proId);
            ?>
                <div class="item" style="background-image: url('<?php echo $url;?>')">
                  
                  <div class="container-fluid">
                    <div class="caption bg-color vertical-center text-left">
                      <div class="big-text fadeInDown-1">
                        <a href="<?php the_permalink(); ?>"><?php echo $product->post->post_title; ?></a>
                      </div>
                      <div class="excerpt fadeInDown-2 hidden-xs">
                         <?php echo $product->post->post_excerpt; ?>
                      </div>
                      <div class="button-holder fadeInDown-3">
                        <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
              </div>
            </div>
           
            <!-- FEATURED PRODUCTS  -->
            <section class="section featured-product wow fadeInUp">
              <h3 class="section-title">Featured products</h3>
              <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
              <?php 
                $args = array(  
                  'post_type' => 'product',  
                  'meta_key' => '_featured',  
                  'meta_value' => 'yes',  
                  'posts_per_page' => 12  
              );  
                
              $featured_query = new WP_Query( $args );  
                    
              if ($featured_query->have_posts()) :   
                
                  while ($featured_query->have_posts()) :   
                    
                      $featured_query->the_post();  
                        
                      $product = get_product( $featured_query->post->ID );  
                      ?>
          
                <div class="item item-carousel">
                  <div class="products">
                    <div class="product">

                      <div class="product-image">
                        <div class="image">
                          <a href="<?php the_permalink();?>">
                            <?php
                            $f_img = get_the_post_thumbnail($product->post->ID);
                             echo '<img  src='.$f_img.'';
                             ?>
                          </a>
                        </div>
                        <?php if ($product->on_sale) {?>
                        <div class="tag hot"><span>
                            <?php echo "Sale";?>
                          </span></div>
                          <?php };?>
                      </div>
                      <div class="product-info text-left">
                        <h3 class="name"><a href="detail.html"><?= $product->name;?></a></h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>
                        <div class="product-price"> 
                          <span class="price">$ <?= $product->price;?></span>
                          <span class="price-before-discount"> </span>
                        </div>
                      </div>
                      <?php echo woocommerce_template_loop_add_to_cart(); ?>
                      <br>
                      <p> <?php echo do_shortcode("[ti_wishlists_addtowishlist]"); ?></p>
                    </div>
                   </div>
                 </div>
                </div>
                 <?php         
                    endwhile;  
                  endif;  
                   wp_reset_query(); 
                   // Remember to reset  ?>
              </div>
            </section>

            <!--  WIDE PRODUCTS -->
            <div class="wide-banners wow fadeInUp outer-bottom-xs">
              <div class="row">
                <div class="col-md-12">
                  <div class="wide-banner cnt-strip">
                    <div class="image">
                      <img class="img-responsive" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/banners/home-banner.jpg" alt="">
                    </div>
                    <div class="strip strip-text">
                      <div class="strip-inner">
                        <h2 class="text-right">New Mens Fashion<br>
                          <span class="shopping-needs">Save up to 40% off</span>
                        </h2>
                      </div>
                    </div>
                    <div class="new-label">
                      <div class="text">NEW</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- BEST SELLER  -->
            <div class="best-deal wow fadeInUp outer-bottom-xs">
              <h3 class="section-title">Best seller</h3>
              <div class="sidebar-widget-body outer-top-xs">
                <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">


                <?php
                $args = array(
                    'post_type' => 'product',
                    'meta_key' => 'total_sales',
                    'orderby' => 'meta_value_num',
                    'posts_per_page' => 20,
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post(); 
                global $product; ?>
                  <div class="item">
                    <div class="products best-product">
                      <div class="product">
                        <div class="product-micro">
                          <div class="row product-micro-row">
                            <div class="col col-xs-5">
                              <div class="product-image">
                                <div class="image">
                                  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                  <?php if (has_post_thumbnail( $loop->post->ID )) 
        echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
        else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="product placeholder Image" width="65px" height="115px" />'; ?>
                                  </a>					
                                </div>
                              </div>
                            </div>
                            <div class="col2 col-xs-7">
                              <div class="product-info">
                                <h3 class="name"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                                <div class="rating rateit-small"></div>
                                <div class="product-price">	
                                  <span class="price">
                                  $450.99				</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
          <?php endwhile; ?>
          <?php wp_reset_query(); ?>
                
                </div>
              </div>
            </div>
            <!--  BLOG SLIDER  -->
            <section class="section latest-blog outer-bottom-vs wow fadeInUp">
              <h3 class="section-title">latest form blog</h3>
              <div class="blog-slider-container outer-top-xs">
                <div class="owl-carousel blog-slider custom-carousel">


                  <?php 
                   // the query
                   $the_query = new WP_Query( array(
                      'posts_per_page' => -1
                   )); 
                ?>

                <?php if ( $the_query->have_posts() ) : ?>
                  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                  <div class="item">
                    <div class="blog-post">
                      <div class="blog-post-image">
                        <div class="image">
                          
                          <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            </a>
                          <?php endif; ?>
                        
                        </div>
                      </div>
                      <div class="blog-post-info text-left">
                        <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                       <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <span class="info">By <?php the_author(); ?> &nbsp;|&nbsp; <?php the_date(); ?> </span>
                        <p class="text"><?php the_excerpt('...'); ?></p>
                        <a href="<?php the_permalink(); ?>" class="lnk btn btn-primary">Read more</a>
                      </div>
                    </div>
                  </div>

              <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

              <?php else : ?>
                <p><?php __('No Post'); ?></p>
              <?php endif; ?>
                 
                </div>
              </div>
            </section>
            <!-- FEATURED PRODUCTS  -->
            <section class="section wow fadeInUp new-arriavls">
              <h3 class="section-title">New Arrivals</h3>
              <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                
                <?php
                $args = array(
                'post_type' => 'product',
                'stock' => 1,
                'posts_per_page' => -1,
                'orderby' =>'date',
                'order' => 'DESC' );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>


                <div class="item item-carousel">
                  <div class="products">
                    <div class="product">
                      <div class="product-image">
                        <div class="image">
                          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="My Image Placeholder" width="65px" height="115px" />'; ?>
                            </a>
                        </div>
                        <div class="tag new"><span>new</span></div>
                      </div>
                      <div class="product-info text-left">
                        <h3 class="name"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                        <div class="rating rateit-small"></div>
                        <div class="description"></div>
                        <div class="product-price">	
                          <span class="price"><?php echo $product->get_price_html(); ?></span>
                        </div>
                      </div>
                      <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                      <br>
                      <p> <?php echo do_shortcode("[ti_wishlists_addtowishlist]"); ?></p>
                    </div>
                  </div>
                </div>
                </div>
              <?php endwhile; ?>
              <?php wp_reset_query(); ?>
              </div>
            </section>
          </div>
        </div>
                <div id="brands-carousel" class="logo-slider wow fadeInUp">
          <div class="logo-slider-inner">
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
              <div class="item m-t-15">
                <a href="#" class="image">
                <img data-echo="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/brand4.png" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blank.gif" alt="">
                </a>	
              </div>
              <div class="item m-t-10">
                <a href="#" class="image">
                <img data-echo="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/brand4.png" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blank.gif" alt="">
                </a>	
              </div>
              <div class="item">
                <a href="#" class="image">
                <img data-echo="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/brand4.png" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blank.gif" alt="">
                </a>	
              </div>
              <div class="item">
                <a href="#" class="image">
                <img data-echo="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/brand4.png" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blank.gif" alt="">
                </a>	
              </div>
              <div class="item">
                <a href="#" class="image">
                <img data-echo="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/brand4.png" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blank.gif" alt="">
                </a>	
              </div>
              <div class="item">
                <a href="#" class="image">
                <img data-echo="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/brand4.png" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blank.gif" alt="">
                </a>	
              </div>
              <div class="item">
                <a href="#" class="image">
                <img data-echo="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/brand4.png" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blank.gif" alt="">
                </a>	
              </div>
              <div class="item">
                <a href="#" class="image">
                <img data-echo="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/brand4.png" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blank.gif" alt="">
                </a>	
              </div>
              <div class="item">
                <a href="#" class="image">
                <img data-echo="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/brand4.png" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blank.gif" alt="">
                </a>	
              </div>
              <div class="item">
                <a href="#" class="image">
                <img data-echo="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/brand4.png" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/blank.gif" alt="">
                </a>	
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FOOTER -->
<?php get_footer();?>
