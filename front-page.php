<?php get_header(); ?>
<?php
  global $wp_query;
?>
<!-- <img src="<?php echo get_template_directory_uri(); ?>/img/atf.jpg" alt=""> -->
<?php while(have_posts()){the_post();
  //the_content();
} ?>


<section class="slider">
  <?php
  $args = array(
    'post_type'=>'product',
    'posts_per_page'=>4,
  );
  $blogPosts=new WP_Query($args); ?>

  <h3 class="sliderTitle">LASTEST <?php echo $wp_query->max_num_pages; ?></h3>
  <?php while($blogPosts->have_posts()){$blogPosts->the_post(); ?>
    <?php global $product; ?>

    <figure class="card">
      <a class="cardImg" href="<?php echo get_permalink(); ?>">
        <img class="cardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
      </a>
      <!-- <figcaption class="cardCaption">
        <h4 class="cardTitle"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h4>
        <p class="productCardTxt"><a href="<?php echo get_permalink(); ?>"><?php echo excerpt(70); ?></a></p>
      </figcaption> -->
    </figure>
  <?php } ?>

  <button class="sliderArrow" type="button" name="button">&#62;</button>

</section>
<a class="btn" href="">View all</a>
    <!-- <div id="more_posts">Load More</div> -->


<?php get_footer(); ?>
