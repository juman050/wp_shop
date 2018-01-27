<?php get_header(); ?>
   <div class="breadcrumb">
      <div class="container">
            <?php woocommerce_breadcrumb(); ?>
      </div>
    </div>
    <div class="body-content">
      <div class="container">
        <div class="row">
          <div class="blog-page">
            <div class="col-md-9">

              <?php 
              while (have_posts()):the_post(); ?>
                <div class="blog-post  wow fadeInUp">
                  <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                  <?php the_content(); ?>
                </div>
              <?php endwhile;?>
             
            
            </div>
            <?php get_template_part('sidebar') ?>
          </div>
        </div>

      </div>
    </div>
<?php get_footer(); ?>