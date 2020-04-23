<?php get_header(); ?>

<div class="stories">

  <h3 class="storiesTitle">STORIES</h3>



  <section class="storiesATF">

    <?php
    $args=array(
      'post_type'=>'post',
      'posts_per_page'=>4,
      'tag' => 'featured',
    );$stories=new WP_Query($args);
    while($stories->have_posts()){$stories->the_post(); ?>
      <figure class="featuredStorie">
        <a class="storieLink" href="<?php the_permalink(); ?>">
          <img class="storieImg lazy" id="storieImg<?php echo get_the_id();?>" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
        </a>
        <figcaption class="featuredStorieTitle">
          <h3><?php the_title(); ?></h3>
        </figcaption>

      </figure>

    <?php } wp_reset_query(); ?>

    </section>

      <!-- SECCION ATF ALTERNATIVA COMENTADA  -->

    <h4 class="archiveStoriesTitle">ALL OF OUR STORIES</h4>


    <section class="archiveStories" id="slider">

    <?php
    // $args=array(
    //   'post_type'=>'post',
    //   'posts_per_page'=>8,
    //   'tag' => '',
    // );$stories=new WP_Query($args);
    while(have_posts()){the_post(); ?>
      <figure class="card" id="card<?php echo get_the_id();?>">
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
          <a class="btn" href="<?php the_permalink(); ?>">Read More</a>
        </figcaption>
      </figure>
    <?php } wp_reset_query(); ?>
    <?php echo misha_paginator(get_pagenum_link()); ?>

  </section>



</div>



<?php get_footer(); ?>
