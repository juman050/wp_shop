<?php
  /*
  Template Name: blog
  */

?>

<?php get_header(); ?>
    <!--  HEADER : END  -->
<div class="body-content">
  <div class="container">
    <div class="row">
       <div class="blog-page">
            <div class="col-md-9">
           <?php 
                   // the query
                   $the_query = new WP_Query( array(
                      'posts_per_page' => -1
                   )); 
                ?>

                <?php if ( $the_query->have_posts() ) : ?>
                  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

              <div class="blog-post  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <?php the_post_thumbnail( 'img-responsive' ); ?>
                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <span class="author"><?php the_author(); ?> </span>
                <span class="review"><?php echo get_comments_number() ?></span>
                <span class="date-time"><?php the_date(); ?></span>
                <p><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>" class="btn btn-upper btn-primary read-more">read more</a>
              </div>
             <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

              <?php else : ?>
                <p><?php __('No Post'); ?></p>
              <?php endif; ?>
                 
         </div>
          <!-- SIDEBAR  -->	
          <?php get_template_part('sidebar'); ?>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>