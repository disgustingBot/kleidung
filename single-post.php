<?php get_header(); ?>

<?php while(have_posts()){the_post(); ?>

<main class="singleStories">

  <section class="singleStorie">

    <figure class="singleStorieFigure">
      <img class="singleStorieImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">

      <button class="sliderArrow" type="button" name="button">&#62;</button>
      <button class="sliderArrow slideLeft" type="button" name="button">&#62;</button>
    </figure>


  </section>
  <section class="singleStorieCaption">
    <h4 class="storieDate">
      <?php echo get_the_date(); ?>
    </h4>
    <h3 class="singleStorieTitle">
      <?php echo the_title(); ?>
    </h3>
    <div class="singleStorieContent">
      <?php echo the_content(); ?>
    </div>
  </section>
  <!--
  ////////////////////
                  SECCION SOCIAL SHARING
  ////////////////////
  -->

  <section class="storieSocialSharing">
    <h5 class="storieSocialSharingTitle">SHARE</h5>
    <?php include 'socialMedia.php'; ?>
  </section>



  <!--
  ////////////////////
                  SECCION OTRAS ENTRADAS
  ////////////////////
  -->
  <h4 class="singleOthersTitle">
    OTRAS ENTRADAS
  </h4>

  <section class="singleStorieOthers">
    <?php $args = array('post_type' => 'post',
    'posts_per_page' => 4, );
    $stories=new WP_Query($args);
    while($stories->have_posts()){$stories->the_post(); ?>
      <figure class="card">
        <a class="storieLink" href="<?php the_permalink(); ?>">
          <img class="cardImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">
        </a>
        <p class="cardStorieDate">
          <?php echo get_the_date( 'j' ); ?>
          <br>
          <?php echo get_the_date( 'M' ); ?>
        </p>
        <figcaption class="cardCaption">
          <h3>
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

<?php } wp_reset_query(); ?>

<?php get_footer(); ?>
