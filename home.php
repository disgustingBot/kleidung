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


    <section class="archiveStories">

    <?php
    $args=array(
      'post_type'=>'post',
      'posts_per_page'=>8,
      'tag' => '',
    );$stories=new WP_Query($args);
    while($stories->have_posts()){$stories->the_post(); ?>
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
          <a class="btn" href="<?php the_permalink(); ?>">
            <span class="readMore">Read More
            <svg width="40" height="16" viewBox="0 0 20 8" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M15 4.95825H0V3.04175H15C13.9217 2.11072 13.5163 1.39965 12.9269 0C15.8187 2.44648 17.3769 3.46462 19.9269 4C17.3769 4.53538 15.8187 5.55352 12.9269 8C13.5163 6.60035 13.9217 5.88928 15 4.95825Z" fill="currentColor"/>
            </svg>
            </span>
          </a>
        </figcaption>
      </figure>
    <?php } wp_reset_query(); ?>

  </section>



</div>



<?php get_footer(); ?>
