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
          <img class="storieImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
        </a>
        <figcaption class="featuredStorieTitle">
          <h3><?php the_title(); ?></h3>
        </figcaption>
      </figure>

    <?php } wp_reset_query(); ?>

    </section>

      <!-- SECCION ATF ALTERNATIVA COMENTADA  -->
<?php if (false): ?>


    <section class="storiesATFAlternativa" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>

      <?php
      $args=array(
        'post_type'=>'post',
        'posts_per_page'=>3,
        'tag' => 'featured',
      );$stories=new WP_Query($args);
      while($stories->have_posts()){$stories->the_post(); ?>
        <figure class="featuredStorie2">
          <a class="storieLink2" href="<?php the_permalink(); ?>">
            <img class="storieImg2 lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
          </a>
          <figcaption class="featuredStorieTitle2">
            <h3><?php the_title(); ?></h3>
          </figcaption>
        </figure>

      <?php } wp_reset_query(); ?>

      <button class="sliderArrow" type="button" name="button">&#62;</button>
      <button class="sliderArrow slideLeft" type="button" name="button">&#62;</button>
      </section>


<?php endif; ?>
      <!-- FIN COMENTARIO  -->


    <h4 class="archiveStoriesTitle">ALL OF OUR STORIES</h4>


    <section class="archiveStories">

    <?php
    $args=array(
      'post_type'=>'post',
      'posts_per_page'=>8,
      'tag' => '',
    );$stories=new WP_Query($args);
    while($stories->have_posts()){$stories->the_post(); ?>
      <figure class="card">
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
          <a class="btnWhite btn" href="<?php the_permalink(); ?>">
            Read More&raquo;
          </a>
        </figcaption>
      </figure>
    <?php } wp_reset_query(); ?>

  </section>



</div>



<?php get_footer(); ?>
