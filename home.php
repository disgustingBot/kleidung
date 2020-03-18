<?php get_header(); ?>

<main class="stories">


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
          <img class="storieImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
        </a>
        <figcaption class="featuredStorieTitle">
          <h3><?php the_title(); ?></h3>
        </figcaption>
      </figure>

    <?php } wp_reset_query(); ?>

    </section>


  <hr>

  <section class="archiveStories">

    <?php
    $args=array(
      'post_type'=>'post',
      'posts_per_page'=>8,
      'tag' => '',
    );$stories=new WP_Query($args);
    while($stories->have_posts()){$stories->the_post(); ?>
      <figure class="card">
        <a class="storieLink" href="<?php the_permalink(); ?>">
          <img class="cardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
        </a>
        <figcaption class="cardCaption">
          <h3 class="cardTitle">
            <?php the_title(); ?>
          </h3>
          <p class="storieDescription">
            <?php echo excerpt(100); ?>
          </p>
          <a class="storieLink btnWhite btn" href="<?php the_permalink(); ?>">
            Read More&raquo;
          </a>
        </figcaption>
      </figure>
    <?php } wp_reset_query(); ?>

  </section>



</main>



<?php get_footer(); ?>
