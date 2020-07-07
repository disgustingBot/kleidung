<?php get_header(); ?>

<div class="stories">
  <div class="ATF">
    <h3 class="storiesTitle">STORIES</h3>
  </div>
    <section class="archiveStories" id="slider">

    <?php

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
