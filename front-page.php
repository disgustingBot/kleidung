<?php get_header(); ?>
<?php
  global $wp_query;
?>
<?php while(have_posts()){the_post();
  //the_content();
} ?>

<section class="homeATF ATF" id="homeATF">
  <video loop muted autoplay class="homeATFVideo rowcol1">
    <source src="<?php echo get_post_meta($post->ID, 'video-portada', true); ?>" type="video/mp4">
  </video>
  <h1 class="homeATFTitle rowcol1"><?php echo get_post_meta($post->ID, 'titulo-portada', true); ?></h1>
</section>



<section class="slider">
  <?php
  $args = array(
    'post_type'=>'product',
    'posts_per_page'=>4,
  );
  $blogPosts=new WP_Query($args); ?>

  <h3 class="sliderTitle title">DISCOVER THE LATEST</h3>
  <?php while($blogPosts->have_posts()){$blogPosts->the_post(); ?>
    <?php global $product; ?>

    <figure class="card">
      <a class="cardImg" href="<?php echo get_permalink(); ?>">
        <img class="cardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
      </a>
      <figcaption class="cardCaption">
        <p class="cardTitle"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></p>
        <p class="productCardPrice"><a href="<?php echo get_permalink(); ?>"> <?php echo $product->get_price_html(); ?> </a></p>
      </figcaption>
    </figure>
  <?php } ?>



  <a class="btn" href="<?php echo site_url('shop'); ?>">View all</a>
</section>

<div class="stickyBannerAndStories">

    <div class="colorCaption">
      <h5 class="colorTitle"><nobr>SLOW FASHON</nobr></h5>
      <p class="colorTxt">Against the overproduction, we bet for exclusivity and take care of the people who work in the manufacturing process.</p>
      <a class="btn" href="<?php echo site_url('brand'); ?>">About us</a>
    </div>
    <img class="colorImg" src="<?php echo get_template_directory_uri(); ?>/img/color.jpg" alt="">
  <!-- <div id="more_posts">Load More</div> -->

  <div class="frontStories">
    <?php $args = array('post_type' => 'post',
    'posts_per_page'=> 3,
    'tag'=> 'featured' );

    $stories=new WP_Query($args);
    while($stories->have_posts()){$stories->the_post(); ?>
      <figure class="card"  id="card<?php echo get_the_id();?>">
        <a class="cardImg" href="<?php the_permalink(); ?>">
          <img class="cardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
        </a>
        <p class="cardStorieDate">
          <?php echo get_the_date( 'j' ); ?>
          <br>
          <?php echo get_the_date( 'M' ); ?>
        </p>
        <figcaption class="cardCaption">
          <h3 class="cardTitle">
            <?php the_title(); ?>
          </h3>
          <p class="cardDescription">
            <?php echo excerpt(100); ?>
          </p>
          <a class="btnWhite btn" href="<?php the_permalink(); ?>">Read More >></a>
        </figcaption>
      </figure>
    <?php } wp_reset_query(); ?>
  </div>


</div>


<?php get_footer(); ?>
