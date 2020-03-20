<?php get_header(); ?>

<?php while(have_posts()){the_post(); ?>





  <?php if (false): ?>

  <div class="storieATF carousel">
      <img class="galleryMain galleryCarousel" onclick="altClassFromSelector('alt','#gallery')" src="<?php echo $image_link = wp_get_attachment_url( $attachment_id ); ?>" alt="">


    <button class="sliderArrow" type="button" name="button">&#62;</button>
    <button class="sliderArrow slideLeft" type="button" name="button">&#62;</button>

  </div>

  <article class="singleStorieCaption">
    <h4 class="cardStorieDate">
      <?php echo get_the_date(); ?>
    </h4>
    <h3 class="singleStorieTitle">
      <?php echo the_title(); ?>
    </h3>
    <main class="singleStorieContent">
      <?php echo the_content(); ?>
    </main>
    <h4 class="cardAuthor">
      <?php echo the_author(); ?>
    </h4>
  </article>


  <div class="othertories">

  </div>


  <?php endif; ?>















  <div class="singleStoriesATF">

    <section class="singleStorie">

      <figure class="singleStorieFigure">
        <img class="singleStorieImg lazy" data-url="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="">

        <!-- <button class="sliderArrow" type="button" name="button">&#62;</button>
        <button class="sliderArrow slideLeft" type="button" name="button">&#62;</button> -->
      </figure>


    </section>
    <div class="singleStorieCaption">
      <h4 class="cardStorieDate">
        <?php echo get_the_date(); ?>
      </h4>
      <h3 class="singleStorieTitle">
        <?php echo the_title(); ?>
      </h3>
      <main class="singleStorieContent">
        <?php echo the_content(); ?>
      </main>
      <h4 class="cardAuthor">
        <?php echo get_the_author(); ?>
      </h4>
    </div>
    <!--
    ////////////////////
    SECCION SOCIAL SHARING
    ////////////////////
  -->




</div>

<div class="singleOthersTitle">
  <figure class="storieSocialSharing">
    <h5 class="storieSocialSharingTitle">SHARE</h5>
    <?php include 'socialMedia.php'; ?>
  </figure>



  <!--
  ////////////////////
  SECCION OTRAS ENTRADAS
  ////////////////////
-->
<h4 class="titleMoreStories">
  OTRAS ENTRADAS
</h4>

<div class="singleStorieOthers">
  <?php $args = array('post_type' => 'post',
  'posts_per_page' => 4, );
  $stories=new WP_Query($args);
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
</div>

</div>


<?php } wp_reset_query(); ?>

<?php get_footer(); ?>
